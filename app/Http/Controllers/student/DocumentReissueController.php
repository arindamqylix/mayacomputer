<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student\DocumentReissueRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use DB;

class DocumentReissueController extends Controller
{
    // Show reissue request form - only document types that are generated for this student
    public function index()
    {
        $student = Auth::guard('student')->user();
        
        // Get all reissue requests for this student
        $requests = DocumentReissueRequest::where('drr_FK_of_student_id', $student->sl_id)
            ->orderBy('drr_id', 'DESC')
            ->get();

        // Group by drr_group_id (same group = one payment); legacy rows without group_id = solo group
        $requestGroups = $requests->groupBy(function ($r) {
            return $r->drr_group_id ?? ('solo_' . $r->drr_id);
        })->map(function ($group) {
            $first = $group->first();
            return (object)[
                'group_id' => $first->drr_group_id ?? ('solo_' . $first->drr_id),
                'items' => $group->values(),
                'total_amount' => $group->sum('drr_amount'),
                'payment_status' => $first->drr_payment_status,
                'request_status' => $first->drr_status,
                'requested_at' => $first->drr_requested_at ?? $first->created_at,
            ];
        })->values();

        // Get active document types from DB
        $allTypes = \App\Models\admin\DocumentType::where('dt_status', 'ACTIVE')->get();
        
        // Filter: show only document types for which this student has that document generated
        $documentTypes = $allTypes->filter(function ($type) use ($student) {
            return $this->studentHasDocumentGenerated($student, $type->dt_name);
        })->values();
        
        return view('student.document_reissue.index', compact('requestGroups', 'student', 'documentTypes'));
    }
    
    /**
     * Check if the given document type has been generated for this student.
     * Result/Marksheet -> set_result exists; Certificate -> student_certificates; Admit Card -> student_admit_cards;
     * ID Card / Registration Card -> always available for registered student.
     */
    protected function studentHasDocumentGenerated($student, $documentTypeName)
    {
        $name = strtolower(trim($documentTypeName));
        $sid = $student->sl_id;
        
        // Result / Marksheet / Statement of Marks
        if (str_contains($name, 'result') || str_contains($name, 'marksheet') || str_contains($name, 'statement of marks')) {
            return DB::table('set_result')->where('sr_FK_of_student_id', $sid)->exists();
        }
        // Certificate (exclude "registration" to avoid matching registration card)
        if (str_contains($name, 'certificate') && !str_contains($name, 'registration')) {
            return DB::table('student_certificates')->where('sc_FK_of_student_id', $sid)->exists();
        }
        // Admit Card (match: admit, admit card, provisional admit, etc.)
        if (str_contains($name, 'admit')) {
            return DB::table('student_admit_cards')->where('student_id', $sid)->exists();
        }
        // ID Card / Identity Card - available for any registered student
        if (str_contains($name, 'id card') || str_contains($name, 'identity') || (str_contains($name, 'id') && str_contains($name, 'card') && !str_contains($name, 'admit'))) {
            return true;
        }
        // Registration Card / Reg Card / Reg. Card - available for any registered student
        if (str_contains($name, 'registration') || str_contains($name, 'reg card') || str_contains($name, 'reg. card') || (str_contains($name, 'reg') && str_contains($name, 'card'))) {
            return true;
        }
        // Default: show if we couldn't match (e.g. custom type names)
        return true;
    }
    
    // Store reissue request(s) - supports multiple document types in one submit
    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required', // array or single value
            'document_type.*' => 'nullable|integer',
            'remarks' => 'nullable|string|max:500',
        ]);
        
        $student = Auth::guard('student')->user();
        $documentTypesInput = $request->document_type;
        
        // Normalize to array (single select sends one value, multiple checkboxes send array)
        if (!is_array($documentTypesInput)) {
            $documentTypesInput = $documentTypesInput ? [$documentTypesInput] : [];
        }
        $documentTypesInput = array_filter(array_unique(array_map('intval', $documentTypesInput)));
        
        if (empty($documentTypesInput)) {
            return redirect()->back()->with('error', 'Please select at least one document type.');
        }
        
        $created = [];
        $skipped = [];
        $group_id = Str::uuid()->toString();

        foreach ($documentTypesInput as $dtId) {
            $docType = \App\Models\admin\DocumentType::where('dt_id', $dtId)
                ->where('dt_status', 'ACTIVE')
                ->first();
            if (!$docType) {
                continue;
            }
            if (!$this->studentHasDocumentGenerated($student, $docType->dt_name)) {
                $skipped[] = $docType->dt_name;
                continue;
            }

            $existingRequest = DocumentReissueRequest::where('drr_FK_of_student_id', $student->sl_id)
                ->where('drr_document_type', $docType->dt_name)
                ->whereIn('drr_status', ['PENDING', 'PAID', 'PROCESSING'])
                ->first();
            if ($existingRequest) {
                $skipped[] = $docType->dt_name . ' (already pending)';
                continue;
            }

            $reissueRequest = DocumentReissueRequest::create([
                'drr_FK_of_student_id' => $student->sl_id,
                'drr_group_id' => $group_id,
                'drr_document_type' => $docType->dt_name,
                'drr_status' => 'PENDING',
                'drr_amount' => $docType->dt_amount,
                'drr_payment_status' => 'PENDING',
                'drr_remarks' => $request->remarks,
            ]);
            $created[] = ['name' => $docType->dt_name, 'id' => $reissueRequest->drr_id];
        }

        if (empty($created)) {
            $msg = !empty($skipped)
                ? 'No new requests created. ' . implode(', ', $skipped)
                : 'Invalid or no document type selected.';
            return redirect()->route('student.document_reissue')->with('error', $msg);
        }

        // One-time payment for entire selection (single or multiple)
        return redirect()->route('student.document_reissue.payment.group', $group_id)
            ->with('success', count($created) . ' document(s) added. Please complete payment in one go.');
    }
    
    // Single-request payment (redirects to group payment for one request)
    public function payment($id)
    {
        $student = Auth::guard('student')->user();
        $reissueRequest = DocumentReissueRequest::where('drr_id', $id)
            ->where('drr_FK_of_student_id', $student->sl_id)
            ->firstOrFail();
        $group_id = $reissueRequest->drr_group_id ?? ('solo_' . $reissueRequest->drr_id);
        return redirect()->route('student.document_reissue.payment.group', $group_id);
    }

    // Legacy: POST to payment/{id} (e.g. old bookmark) — delegate to group process
    public function processPayment(Request $request, $id)
    {
        $student = Auth::guard('student')->user();
        $reissueRequest = DocumentReissueRequest::where('drr_id', $id)
            ->where('drr_FK_of_student_id', $student->sl_id)
            ->firstOrFail();
        $group_id = $reissueRequest->drr_group_id ?? ('solo_' . $reissueRequest->drr_id);
        return $this->processPaymentGroup($request, $group_id);
    }

    // One-time payment for a group (single or multiple documents)
    public function paymentGroup($group_id)
    {
        $student = Auth::guard('student')->user();

        if (str_starts_with($group_id, 'solo_')) {
            $id = (int) str_replace('solo_', '', $group_id);
            $requests = DocumentReissueRequest::where('drr_id', $id)
                ->where('drr_FK_of_student_id', $student->sl_id)
                ->get();
        } else {
            $requests = DocumentReissueRequest::where('drr_group_id', $group_id)
                ->where('drr_FK_of_student_id', $student->sl_id)
                ->orderBy('drr_id')
                ->get();
        }

        if ($requests->isEmpty()) {
            return redirect()->route('student.document_reissue')->with('error', 'Request not found.');
        }

        if ($requests->first()->drr_payment_status === 'PAID') {
            return redirect()->route('student.document_reissue')->with('info', 'Payment already completed for this request.');
        }

        $totalAmount = $requests->sum('drr_amount');

        $api = new Api('rzp_test_Yyokf06rQ4WTfd', 'JJKf3XS4Od0o063uU3kdkVAK');
        // Razorpay receipt max 40 chars; group_id is UUID (36 chars) so use short hash
            $receipt = 'GRP_' . substr(md5($group_id), 0, 36);
            $order = $api->order->create([
            'receipt' => $receipt,
            'amount' => (int) round($totalAmount * 100),
            'currency' => 'INR',
            'notes' => [
                'group_id' => $group_id,
                'student_id' => $student->sl_id,
            ]
        ]);
        $orderId = $order['id'];

        foreach ($requests as $req) {
            $req->update(['drr_payment_id' => $orderId]);
        }

        Session::put('reissue_group_id', $group_id);
        Session::put('reissue_order_id', $orderId);
        Session::put('reissue_amount', $totalAmount);

        return view('student.document_reissue.payment_group', [
            'requests' => $requests,
            'student' => $student,
            'orderId' => $orderId,
            'totalAmount' => $totalAmount,
            'group_id' => $group_id,
        ]);
    }
    
    // Verify and process Razorpay payment for a group
    public function processPaymentGroup(Request $request, $group_id)
    {
        $student = Auth::guard('student')->user();

        if (str_starts_with($group_id, 'solo_')) {
            $id = (int) str_replace('solo_', '', $group_id);
            $requests = DocumentReissueRequest::where('drr_id', $id)
                ->where('drr_FK_of_student_id', $student->sl_id)
                ->get();
        } else {
            $requests = DocumentReissueRequest::where('drr_group_id', $group_id)
                ->where('drr_FK_of_student_id', $student->sl_id)
                ->get();
        }

        if ($requests->isEmpty()) {
            return redirect()->route('student.document_reissue')->with('error', 'Request not found.');
        }
        if ($requests->first()->drr_payment_status === 'PAID') {
            return redirect()->route('student.document_reissue')->with('info', 'Payment already completed.');
        }

        $api = new Api('rzp_test_Yyokf06rQ4WTfd', 'JJKf3XS4Od0o063uU3kdkVAK');
        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_signature' => $request->razorpay_signature,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
            ]);
            $success = true;
        } catch (SignatureVerificationError $e) {
            $success = false;
        }

        if ($success) {
            foreach ($requests as $req) {
                $req->update([
                    'drr_payment_status' => 'PAID',
                    'drr_status' => 'PAID',
                    'drr_payment_id' => $request->razorpay_payment_id,
                ]);
            }
            Session::forget(['reissue_group_id', 'reissue_order_id', 'reissue_amount']);
            return redirect()->route('student.document_reissue')->with('success', 'Payment completed successfully! Your request(s) are now under processing.');
        }

        return redirect()->route('student.document_reissue.payment.group', $group_id)
            ->with('error', 'Payment verification failed. Please try again.');
    }
    
    // View request details
    public function show($id)
    {
        $student = Auth::guard('student')->user();
        
        $reissueRequest = DocumentReissueRequest::where('drr_id', $id)
            ->where('drr_FK_of_student_id', $student->sl_id)
            ->with('student')
            ->firstOrFail();
        
        return view('student.document_reissue.show', compact('reissueRequest', 'student'));
    }
}

