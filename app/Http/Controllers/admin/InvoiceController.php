<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Recharge;
use App\Models\center\Center;
use PDF;
use DB;

class InvoiceController extends Controller
{
    // List all center wallet recharge invoices
    // List all center wallet recharge invoices
    public function centerRechargeInvoices(Request $request)
    {
        $centers = Center::orderBy('cl_center_name', 'asc')->get();

        $query = Recharge::with('center')
            ->where('cr_status', 1)
            ->orderBy('cr_id', 'DESC');

        if ($request->has('center_id') && !empty($request->center_id)) {
            $query->where('cr_FK_of_center_id', $request->center_id);
        }

        $invoices = $query->get();
        $selectedCenterId = $request->center_id;

        return view('admin.invoice.center_recharge_list', compact('invoices', 'centers', 'selectedCenterId'));
    }

    // View center wallet recharge invoice
    public function viewCenterRechargeInvoice($id)
    {
        $recharge = Recharge::with('center')
            ->where('cr_id', $id)
            ->where('cr_status', 1)
            ->firstOrFail();

        // Generate invoice number based on financial year
        $invoiceNo = $this->generateInvoiceNumberForRecharge($recharge);

        $data = [
            'recharge' => $recharge,
            'invoice_no' => $invoiceNo,
            'invoice_date' => date('d-M-Y', strtotime($recharge->created_at)),
        ];

        return view('admin.invoice.center_recharge_invoice', $data);
    }

    // Download center wallet recharge invoice as PDF
    public function downloadCenterRechargeInvoice($id)
    {
        $recharge = Recharge::with('center')
            ->where('cr_id', $id)
            ->where('cr_status', 1)
            ->firstOrFail();

        // Generate invoice number based on financial year
        $invoiceNo = $this->generateInvoiceNumberForRecharge($recharge);

        $data = [
            'recharge' => $recharge,
            'invoice_no' => $invoiceNo,
            'invoice_date' => date('d-M-Y', strtotime($recharge->created_at)),
        ];

        $pdf = PDF::loadView('admin.invoice.center_recharge_invoice_pdf', $data);
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
            ->where(function ($query) use ($recharge, $date) {
                $query->where('created_at', '<', $date->format('Y-m-d H:i:s'))
                    ->orWhere(function ($q) use ($recharge, $date) {
                        $q->whereDate('created_at', $date->format('Y-m-d'))
                            ->where('cr_id', '<=', $recharge->cr_id);
                    });
            })
            ->count();

        $sequenceNumber = $sequenceNumber + 1;

        // Format: MCC/2025-26/01
        return 'MCC/' . $financialYear . '/' . str_pad($sequenceNumber, 2, '0', STR_PAD_LEFT);
    }
    // Download transaction invoice/receipt as PDF
    public function downloadTransactionInvoice($id)
    {
        $transaction = DB::table('transaction')
            ->where('t_id', $id)
            ->first();

        if (!$transaction) {
            abort(404);
        }

        $center = Center::find($transaction->t_FK_of_center_id);

        // Generate invoice/receipt number
        $invoiceNo = 'TRX-' . str_pad($transaction->t_id, 8, '0', STR_PAD_LEFT);

        $data = [
            'transaction' => $transaction,
            'center' => $center,
            'invoice_no' => $invoiceNo,
            'invoice_date' => date('d-M-Y', strtotime($transaction->created_at)),
        ];

        $pdf = PDF::loadView('admin.invoice.transaction_invoice_pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Transaction_Receipt_' . $invoiceNo . '.pdf');
    }
}

