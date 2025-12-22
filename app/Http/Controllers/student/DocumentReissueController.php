<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student\DocumentReissueRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use DB;

class DocumentReissueController extends Controller
{
    // Document reissue prices (can be moved to database or config file)
    private $documentPrices = [
        'CERTIFICATE' => 500.00,
        'MARKSHEET' => 300.00,
        'ID_CARD' => 200.00,
    ];
    
    // Show reissue request form
    public function index()
    {
        $student = Auth::guard('student')->user();
        
        // Get all reissue requests for this student
        $requests = DocumentReissueRequest::where('drr_FK_of_student_id', $student->sl_id)
            ->orderBy('drr_id', 'DESC')
            ->get();
        
        return view('student.document_reissue.index', compact('requests', 'student'));
    }
    
    // Store reissue request
    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:CERTIFICATE,MARKSHEET,ID_CARD',
            'remarks' => 'nullable|string|max:500',
        ]);
        
        $student = Auth::guard('student')->user();
        $documentType = $request->document_type;
        $amount = $this->documentPrices[$documentType] ?? 0;
        
        // Check for existing pending request
        $existingRequest = DocumentReissueRequest::where('drr_FK_of_student_id', $student->sl_id)
            ->where('drr_document_type', $documentType)
            ->whereIn('drr_status', ['PENDING', 'PAID', 'PROCESSING'])
            ->first();
        
        if ($existingRequest) {
            return redirect()->route('student.document_reissue')->with('error', 'You already have a pending request for this document type!');
        }
        
        // Create reissue request
        $reissueRequest = DocumentReissueRequest::create([
            'drr_FK_of_student_id' => $student->sl_id,
            'drr_document_type' => $documentType,
            'drr_status' => 'PENDING',
            'drr_amount' => $amount,
            'drr_payment_status' => 'PENDING',
            'drr_remarks' => $request->remarks,
        ]);
        
        return redirect()->route('student.document_reissue.payment', $reissueRequest->drr_id)
            ->with('success', 'Reissue request created successfully. Please proceed with payment.');
    }
    
    // Initialize Razorpay payment
    public function payment($id)
    {
        $student = Auth::guard('student')->user();
        
        $reissueRequest = DocumentReissueRequest::where('drr_id', $id)
            ->where('drr_FK_of_student_id', $student->sl_id)
            ->firstOrFail();
        
        if ($reissueRequest->drr_payment_status === 'PAID') {
            return redirect()->route('student.document_reissue')->with('info', 'Payment already completed for this request.');
        }
        
        // Initialize Razorpay API
        $api = new Api('rzp_test_Yyokf06rQ4WTfd', 'JJKf3XS4Od0o063uU3kdkVAK');
        
        // Create order
        $order = $api->order->create([
            'receipt' => 'REISSUE_' . $id,
            'amount' => $reissueRequest->drr_amount * 100, // Amount in paise
            'currency' => 'INR',
            'notes' => [
                'request_id' => $reissueRequest->drr_id,
                'document_type' => $reissueRequest->drr_document_type,
                'student_id' => $student->sl_id,
            ]
        ]);
        
        $orderId = $order['id'];
        
        // Update request with order ID
        $reissueRequest->update([
            'drr_payment_id' => $orderId
        ]);
        
        // Store in session for verification
        Session::put('reissue_order_id', $orderId);
        Session::put('reissue_amount', $reissueRequest->drr_amount);
        Session::put('reissue_request_id', $id);
        
        return view('student.document_reissue.payment', compact('reissueRequest', 'student', 'orderId'));
    }
    
    // Verify and process Razorpay payment
    public function processPayment(Request $request, $id)
    {
        $student = Auth::guard('student')->user();
        
        $reissueRequest = DocumentReissueRequest::where('drr_id', $id)
            ->where('drr_FK_of_student_id', $student->sl_id)
            ->firstOrFail();
        
        if ($reissueRequest->drr_payment_status === 'PAID') {
            return redirect()->route('student.document_reissue')->with('info', 'Payment already completed.');
        }
        
        // Initialize Razorpay API
        $api = new Api('rzp_test_Yyokf06rQ4WTfd', 'JJKf3XS4Od0o063uU3kdkVAK');
        
        try {
            $attributes = [
                'razorpay_signature' => $request->razorpay_signature,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
            ];
            
            $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        } catch (SignatureVerificationError $e) {
            $success = false;
        }
        
        if ($success) {
            // Payment verified successfully
            $reissueRequest->update([
                'drr_payment_status' => 'PAID',
                'drr_status' => 'PAID',
                'drr_payment_id' => $request->razorpay_payment_id,
            ]);
            
            // Clear session
            Session::forget(['reissue_order_id', 'reissue_amount', 'reissue_request_id']);
            
            return redirect()->route('student.document_reissue')->with('success', 'Payment completed successfully! Your request is now under processing.');
        } else {
            return redirect()->route('student.document_reissue.payment', $id)
                ->with('error', 'Payment verification failed. Please try again.');
        }
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

