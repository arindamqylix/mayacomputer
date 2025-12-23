<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Recharge;
use App\Models\center\FeesPayment;
use App\Models\center\Center;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;

class InvoiceController extends Controller
{
    // List center's wallet recharge invoices
    public function walletRechargeInvoices()
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        $invoices = Recharge::where('cr_FK_of_center_id', $centerId)
            ->where('cr_status', 1)
            ->orderBy('cr_id', 'DESC')
            ->get();
        
        return view('center.invoice.wallet_recharge_list', compact('invoices'));
    }
    
    // View center wallet recharge invoice
    public function viewWalletRechargeInvoice($id)
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        $recharge = Recharge::where('cr_id', $id)
            ->where('cr_FK_of_center_id', $centerId)
            ->where('cr_status', 1)
            ->firstOrFail();
        
        $center = Center::find($centerId);
        
        return view('center.invoice.wallet_recharge_invoice', compact('recharge', 'center'));
    }
    
    // Download center wallet recharge invoice as PDF
    public function downloadWalletRechargeInvoice($id)
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        $recharge = Recharge::where('cr_id', $id)
            ->where('cr_FK_of_center_id', $centerId)
            ->where('cr_status', 1)
            ->firstOrFail();
        
        $center = Center::find($centerId);
        
        $data = [
            'recharge' => $recharge,
            'center' => $center,
            'invoice_no' => 'INV-WLT-' . str_pad($recharge->cr_id, 6, '0', STR_PAD_LEFT),
            'invoice_date' => date('d-M-Y', strtotime($recharge->created_at)),
        ];
        
        $pdf = PDF::loadView('center.invoice.wallet_recharge_invoice_pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Invoice_Wallet_Recharge_' . $recharge->cr_id . '.pdf');
    }
    
    // List student fee payment invoices for this center
    public function studentPaymentInvoices()
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        $invoices = FeesPayment::with('student')
            ->where('fp_FK_of_center_id', $centerId)
            ->orderBy('fp_id', 'DESC')
            ->get();
        
        return view('center.invoice.student_payment_list', compact('invoices'));
    }
    
    // View student fee payment invoice
    public function viewStudentPaymentInvoice($id)
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        $payment = FeesPayment::with('student')
            ->where('fp_id', $id)
            ->where('fp_FK_of_center_id', $centerId)
            ->firstOrFail();
        
        $center = Center::find($centerId);
        
        // Get student details with course
        $student = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_id', $payment->fp_FK_of_student_id)
            ->select('student_login.*', 'course.c_full_name as course_name')
            ->first();
        
        return view('center.invoice.student_payment_invoice', compact('payment', 'center', 'student'));
    }
    
    // Download student fee payment invoice as PDF
    public function downloadStudentPaymentInvoice($id)
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        $payment = FeesPayment::where('fp_id', $id)
            ->where('fp_FK_of_center_id', $centerId)
            ->firstOrFail();
        
        $center = Center::find($centerId);
        
        // Get student details with course
        $student = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_id', $payment->fp_FK_of_student_id)
            ->select('student_login.*', 'course.c_full_name as course_name', 'course.c_duration')
            ->first();
        
        $data = [
            'payment' => $payment,
            'center' => $center,
            'student' => $student,
            'invoice_no' => $payment->fp_receipt_no,
            'invoice_date' => date('d-M-Y', strtotime($payment->fp_date)),
        ];
        
        $pdf = PDF::loadView('center.invoice.student_payment_invoice_pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Invoice_Fee_Payment_' . $payment->fp_receipt_no . '.pdf');
    }
}

