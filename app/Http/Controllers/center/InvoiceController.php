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
        
        // Generate invoice number based on financial year
        $invoiceNo = $this->generateInvoiceNumberForRecharge($recharge);
        
        $data = [
            'recharge' => $recharge,
            'center' => $center,
            'invoice_no' => $invoiceNo,
            'invoice_date' => date('d-M-Y', strtotime($recharge->created_at)),
        ];
        
        return view('center.invoice.wallet_recharge_invoice', $data);
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
        
        // Generate invoice number based on financial year
        $invoiceNo = $this->generateInvoiceNumberForRecharge($recharge);
        
        $data = [
            'recharge' => $recharge,
            'center' => $center,
            'invoice_no' => $invoiceNo,
            'invoice_date' => date('d-M-Y', strtotime($recharge->created_at)),
        ];
        
        $pdf = PDF::loadView('center.invoice.wallet_recharge_invoice_pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Invoice_Wallet_Recharge_' . $recharge->cr_id . '.pdf');
    }
    
    /**
     * Generate invoice number for recharge based on financial year
     * Format: MCC/YYYY-YY/NN
     * Example: MCC/2025-26/01
     */
    private function generateInvoiceNumberForRecharge($recharge)
    {
        $date = \Carbon\Carbon::parse($recharge->created_at);
        $financialYear = getFinancialYear($date);
        
        // Get all recharges in the same financial year, ordered by created_at and cr_id
        $financialYearStart = $date->month >= 4 
            ? \Carbon\Carbon::create($date->year, 4, 1)
            : \Carbon\Carbon::create($date->year - 1, 4, 1);
        
        $financialYearEnd = $financialYearStart->copy()->addYear()->subDay();
        
        // Count recharges in this financial year that were created before or on the same date
        // For same date, use cr_id to determine order
        $sequenceNumber = DB::table('center_recharge')
            ->where('cr_status', 1)
            ->whereBetween('created_at', [$financialYearStart, $financialYearEnd])
            ->where(function($query) use ($recharge, $date) {
                $query->where('created_at', '<', $date->format('Y-m-d H:i:s'))
                      ->orWhere(function($q) use ($recharge, $date) {
                          $q->whereDate('created_at', $date->format('Y-m-d'))
                            ->where('cr_id', '<=', $recharge->cr_id);
                      });
            })
            ->count();
        
        $sequenceNumber = $sequenceNumber + 1;
        
        // Format: MCC/2025-26/01
        return 'MCC/' . $financialYear . '/' . str_pad($sequenceNumber, 2, '0', STR_PAD_LEFT);
    }
    
    // List student fee payment invoices for this center
    public function studentPaymentInvoices()
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        // Only show invoices (where fp_is_invoice = 1)
        $invoices = FeesPayment::with('student')
            ->where('fp_FK_of_center_id', $centerId)
            ->where('fp_is_invoice', 1)
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
            ->where('fp_is_invoice', 1) // Only allow viewing invoices
            ->firstOrFail();
        
        $center = Center::find($centerId);
        
        // Get student details with course and set_fee for total course fee
        $student = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->leftJoin('set_fee', 'student_login.sl_id', 'set_fee.sf_FK_of_student_id')
            ->where('student_login.sl_id', $payment->fp_FK_of_student_id)
            ->select(
                'student_login.*', 
                'course.c_full_name as course_name',
                'course.c_short_name',
                'set_fee.sf_amount as total_course_fee'
            )
            ->first();
        
        // Ensure center details are loaded
        if (!$center) {
            $center = Center::find($centerId);
        }
        
        // Generate invoice number based on financial year
        $invoiceNo = $this->generateInvoiceNumberForStudentPayment($payment);
        
        return view('center.invoice.student_payment_invoice', compact('payment', 'center', 'student', 'invoiceNo'));
    }
    
    // Download student fee payment invoice as PDF
    public function downloadStudentPaymentInvoice($id)
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        $payment = FeesPayment::where('fp_id', $id)
            ->where('fp_FK_of_center_id', $centerId)
            ->where('fp_is_invoice', 1) // Only allow downloading invoices
            ->firstOrFail();
        
        $center = Center::find($centerId);
        
        // Get student details with course and set_fee for total course fee
        $student = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->leftJoin('set_fee', 'student_login.sl_id', 'set_fee.sf_FK_of_student_id')
            ->where('student_login.sl_id', $payment->fp_FK_of_student_id)
            ->select(
                'student_login.*', 
                'course.c_full_name as course_name',
                'course.c_short_name',
                'course.c_duration',
                'set_fee.sf_amount as total_course_fee'
            )
            ->first();
        
        // Ensure center details are loaded
        if (!$center) {
            $center = Center::find($centerId);
        }
        
        // Generate invoice number based on financial year
        $invoiceNo = $this->generateInvoiceNumberForStudentPayment($payment);
        
        $data = [
            'payment' => $payment,
            'center' => $center,
            'student' => $student,
            'invoice_no' => $invoiceNo,
            'invoice_date' => date('d-M-Y', strtotime($payment->fp_date)),
        ];
        
        $pdf = PDF::loadView('center.invoice.student_payment_invoice_pdf', $data);
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

