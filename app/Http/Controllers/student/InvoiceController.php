<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\FeesPayment;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;

class InvoiceController extends Controller
{
    // List student's fee payment invoices
    public function feePaymentInvoices()
    {
        $studentId = Auth::guard('student')->user()->sl_id;
        
        $invoices = FeesPayment::where('fp_FK_of_student_id', $studentId)
            ->orderBy('fp_id', 'DESC')
            ->get();
        
        return view('student.invoice.fee_payment_list', compact('invoices'));
    }
    
    // View student fee payment invoice
    public function viewFeePaymentInvoice($id)
    {
        $studentId = Auth::guard('student')->user()->sl_id;
        
        $payment = FeesPayment::where('fp_id', $id)
            ->where('fp_FK_of_student_id', $studentId)
            ->firstOrFail();
        
        // Get student details with course and center
        $student = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->where('student_login.sl_id', $studentId)
            ->select('student_login.*', 'course.c_full_name as course_name', 'center_login.*')
            ->first();
        
        return view('student.invoice.fee_payment_invoice', compact('payment', 'student'));
    }
    
    // Download student fee payment invoice as PDF
    public function downloadFeePaymentInvoice($id)
    {
        $studentId = Auth::guard('student')->user()->sl_id;
        
        $payment = FeesPayment::where('fp_id', $id)
            ->where('fp_FK_of_student_id', $studentId)
            ->firstOrFail();
        
        // Get student details with course and center
        $student = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->where('student_login.sl_id', $studentId)
            ->select('student_login.*', 'course.c_full_name as course_name', 'center_login.*')
            ->first();
        
        $data = [
            'payment' => $payment,
            'student' => $student,
            'invoice_no' => $payment->fp_receipt_no,
            'invoice_date' => date('d-M-Y', strtotime($payment->fp_date)),
        ];
        
        $pdf = PDF::loadView('student.invoice.fee_payment_invoice_pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Invoice_Fee_Payment_' . $payment->fp_receipt_no . '.pdf');
    }
}

