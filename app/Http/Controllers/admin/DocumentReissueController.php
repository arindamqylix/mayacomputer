<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student\DocumentReissueRequest;
use DB;
use Carbon\Carbon;

class DocumentReissueController extends Controller
{
    // List all document reissue requests
    public function index()
    {
        $requests = DB::table('document_reissue_requests')
            ->join('student_login', 'document_reissue_requests.drr_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
            ->select(
                'document_reissue_requests.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_email',
                'student_login.sl_mobile_no',
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->orderBy('document_reissue_requests.drr_id', 'DESC')
            ->get();

        return view('admin.document_reissue.index', compact('requests'));
    }

    // View request details
    public function show($id)
    {
        $request = DB::table('document_reissue_requests')
            ->join('student_login', 'document_reissue_requests.drr_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('document_reissue_requests.drr_id', $id)
            ->select(
                'document_reissue_requests.*',
                'student_login.*',
                'center_login.cl_center_name',
                'center_login.cl_code',
                'center_login.cl_center_address'
            )
            ->first();

        if (!$request) {
            return redirect()->route('admin.document_reissue.index')->with('error', 'Request not found!');
        }

        return view('admin.document_reissue.show', compact('request'));
    }

    // Update request status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,PAID,PROCESSING,COMPLETED,REJECTED',
            'admin_remarks' => 'nullable|string|max:500',
        ]);

        $reissueRequest = DocumentReissueRequest::findOrFail($id);

        $updateData = [
            'drr_status' => $request->status,
        ];

        if ($request->filled('admin_remarks')) {
            $updateData['drr_admin_remarks'] = $request->admin_remarks;
        }

        if ($request->status == 'COMPLETED' || $request->status == 'PROCESSING') {
            $updateData['drr_processed_at'] = Carbon::now();
        }

        $reissueRequest->update($updateData);

        return redirect()->route('admin.document_reissue.show', $id)
            ->with('success', 'Request status updated successfully!');
    }

    // Approve request (mark as processing)
    public function approve($id)
    {
        $reissueRequest = DocumentReissueRequest::findOrFail($id);
        
        if ($reissueRequest->drr_payment_status !== 'PAID') {
            return redirect()->back()->with('error', 'Cannot approve request. Payment not completed.');
        }

        $reissueRequest->update([
            'drr_status' => 'PROCESSING',
            'drr_processed_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Request approved and marked as processing!');
    }

    // Complete request
    public function complete($id)
    {
        $reissueRequest = DocumentReissueRequest::findOrFail($id);
        
        $reissueRequest->update([
            'drr_status' => 'COMPLETED',
            'drr_processed_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Request marked as completed!');
    }

    // Reject request
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_remarks' => 'required|string|max:500',
        ]);

        $reissueRequest = DocumentReissueRequest::findOrFail($id);
        
        $reissueRequest->update([
            'drr_status' => 'REJECTED',
            'drr_admin_remarks' => $request->admin_remarks,
            'drr_processed_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Request rejected!');
    }
}

