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
        
        // Only show invoices (where fp_is_invoice = 1)
        $invoices = FeesPayment::where('fp_FK_of_student_id', $studentId)
            ->where('fp_is_invoice', 1)
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
            ->where('fp_is_invoice', 1) // Only allow viewing invoices
            ->firstOrFail();
        
        // Get student details with course, center, and set_fee for total course fee
        $student = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->leftJoin('set_fee', 'student_login.sl_id', 'set_fee.sf_FK_of_student_id')
            ->where('student_login.sl_id', $studentId)
            ->select(
                'student_login.*', 
                'course.c_full_name as course_name',
                'course.c_short_name',
                'center_login.cl_center_name',
                'center_login.cl_code',
                'center_login.cl_center_address',
                'center_login.cl_email',
                'center_login.cl_mobile',
                'set_fee.sf_amount as total_course_fee'
            )
            ->first();
        
        return view('student.invoice.fee_payment_invoice', compact('payment', 'student'));
    }
    
    // Download student fee payment invoice as PDF
    public function downloadFeePaymentInvoice($id)
    {
        $studentId = Auth::guard('student')->user()->sl_id;
        
        $payment = FeesPayment::where('fp_id', $id)
            ->where('fp_FK_of_student_id', $studentId)
            ->where('fp_is_invoice', 1) // Only allow downloading invoices
            ->firstOrFail();
        
        // Get student details with course, center, and set_fee for total course fee
        $student = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->leftJoin('set_fee', 'student_login.sl_id', 'set_fee.sf_FK_of_student_id')
            ->where('student_login.sl_id', $studentId)
            ->select(
                'student_login.*', 
                'course.c_full_name as course_name',
                'course.c_short_name',
                'center_login.*',
                'set_fee.sf_amount as total_course_fee'
            )
            ->first();
        
        // Generate invoice number based on financial year
        $invoiceNo = $this->generateInvoiceNumberForStudentPayment($payment);
        
        $data = [
            'payment' => $payment,
            'student' => $student,
            'invoice_no' => $invoiceNo,
            'invoice_date' => date('d-M-Y', strtotime($payment->fp_date)),
        ];
        
        $pdf = PDF::loadView('student.invoice.fee_payment_invoice_pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Invoice_Fee_Payment_' . $invoiceNo . '.pdf');
    }
    
    /**
     * Generate invoice number for student payment based on financial year
     * Format: MCC/YYYY-YY/NN
     * Example: MCC/2025-26/01
     */
    private function generateInvoiceNumberForStudentPayment($payment)
    {
        $date = \Carbon\Carbon::parse($payment->fp_date);
        $financialYear = getFinancialYear($date);
        
        // Get all invoice payments in the same financial year, ordered by date and fp_id
        $financialYearStart = $date->month >= 4 
            ? \Carbon\Carbon::create($date->year, 4, 1)
            : \Carbon\Carbon::create($date->year - 1, 4, 1);
        
        $financialYearEnd = $financialYearStart->copy()->addYear()->subDay();
        
        // Count invoice payments in this financial year that were created before or on the same date
        $sequenceNumber = DB::table('fees_payment')
            ->where('fp_is_invoice', 1)
            ->whereBetween('fp_date', [$financialYearStart->format('Y-m-d'), $financialYearEnd->format('Y-m-d')])
            ->where(function($query) use ($payment, $date) {
                $query->where('fp_date', '<', $date->format('Y-m-d'))
                      ->orWhere(function($q) use ($payment, $date) {
                          $q->whereDate('fp_date', $date->format('Y-m-d'))
                            ->where('fp_id', '<=', $payment->fp_id);
                      });
            })
            ->count();
        
        $sequenceNumber = $sequenceNumber + 1;
        
        // Format: MCC/2025-26/01
        return 'MCC/' . $financialYear . '/' . str_pad($sequenceNumber, 2, '0', STR_PAD_LEFT);
    }
}

