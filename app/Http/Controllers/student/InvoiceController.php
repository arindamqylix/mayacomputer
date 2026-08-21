<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\center\FeesPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use DB;

class InvoiceController extends Controller
{
    private function loggedInStudent()
    {
        return Auth::guard('student')->user();
    }

    private function personPaymentsQuery()
    {
        return student_fee_payments_query($this->loggedInStudent());
    }

    private function findPersonPayment(int $paymentId): FeesPayment
    {
        return $this->personPaymentsQuery()
            ->where('fp_id', $paymentId)
            ->firstOrFail();
    }

    // List student's fee payments / invoices (all installments; invoice PDF when marked)
    public function feePaymentInvoices()
    {
        $invoices = $this->personPaymentsQuery()
            ->orderBy('fp_id', 'DESC')
            ->get();

        return view('student.invoice.fee_payment_list', compact('invoices'));
    }

    // View student fee payment invoice
    public function viewFeePaymentInvoice($id)
    {
        $payment = $this->findPersonPayment((int) $id);
        $student = $this->studentDetailsForPayment($payment);

        return view('student.invoice.fee_payment_invoice', compact('payment', 'student'));
    }

    // Download student fee payment invoice as PDF
    public function downloadFeePaymentInvoice($id)
    {
        $payment = $this->findPersonPayment((int) $id);
        $student = $this->studentDetailsForPayment($payment);

        $invoiceNo = $this->generateInvoiceNumberForStudentPayment($payment);

        $data = [
            'payment' => $payment,
            'student' => $student,
            'invoice_no' => $invoiceNo,
            'invoice_date' => date('d-M-Y', strtotime($payment->fp_date)),
            'forPdf' => true,
        ];

        $pdf = PDF::loadView('student.invoice.fee_payment_invoice_pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Invoice_Fee_Payment_' . $invoiceNo . '.pdf');
    }

    private function studentDetailsForPayment(FeesPayment $payment)
    {
        $studentId = (int) $payment->fp_FK_of_student_id;

        return DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->leftJoin('set_fee', 'student_login.sl_id', 'set_fee.sf_FK_of_student_id')
            ->where('student_login.sl_id', $studentId)
            ->select(
                'student_login.*',
                'course.c_full_name as course_name',
                'course.c_short_name',
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code',
                'center_login.cl_center_address',
                'center_login.cl_email',
                'center_login.cl_mobile',
                'set_fee.sf_amount as total_course_fee'
            )
            ->first();
    }

    /**
     * Generate invoice number for student payment based on financial year
     * Format: MCC/YYYY-YY/NN
     */
    private function generateInvoiceNumberForStudentPayment($payment)
    {
        $date = \Carbon\Carbon::parse($payment->fp_date);
        $financialYear = getFinancialYear($date);

        $financialYearStart = $date->month >= 4
            ? \Carbon\Carbon::create($date->year, 4, 1)
            : \Carbon\Carbon::create($date->year - 1, 4, 1);

        $financialYearEnd = $financialYearStart->copy()->addYear()->subDay();

        $sequenceQuery = DB::table('fees_payment')
            ->whereBetween('fp_date', [$financialYearStart->format('Y-m-d'), $financialYearEnd->format('Y-m-d')]);

        if (Schema::hasColumn('fees_payment', 'fp_is_invoice')) {
            $sequenceQuery->where('fp_is_invoice', 1);
        }

        $sequenceNumber = $sequenceQuery
            ->where(function ($query) use ($payment, $date) {
                $query->where('fp_date', '<', $date->format('Y-m-d'))
                    ->orWhere(function ($q) use ($payment, $date) {
                        $q->whereDate('fp_date', $date->format('Y-m-d'))
                            ->where('fp_id', '<=', $payment->fp_id);
                    });
            })
            ->count();

        return 'MCC/' . $financialYear . '/' . str_pad($sequenceNumber + 1, 2, '0', STR_PAD_LEFT);
    }
}
