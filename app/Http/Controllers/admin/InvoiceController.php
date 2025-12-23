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
    public function centerRechargeInvoices()
    {
        $invoices = Recharge::with('center')
            ->where('cr_status', 1)
            ->orderBy('cr_id', 'DESC')
            ->get();
        
        return view('admin.invoice.center_recharge_list', compact('invoices'));
    }
    
    // View center wallet recharge invoice
    public function viewCenterRechargeInvoice($id)
    {
        $recharge = Recharge::with('center')
            ->where('cr_id', $id)
            ->where('cr_status', 1)
            ->firstOrFail();
        
        $data = [
            'recharge' => $recharge,
            'invoice_no' => 'INV-WLT-' . str_pad($recharge->cr_id, 6, '0', STR_PAD_LEFT),
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
        
        $data = [
            'recharge' => $recharge,
            'invoice_no' => 'INV-WLT-' . str_pad($recharge->cr_id, 6, '0', STR_PAD_LEFT),
            'invoice_date' => date('d-M-Y', strtotime($recharge->created_at)),
        ];
        
        $pdf = PDF::loadView('admin.invoice.center_recharge_invoice_pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Invoice_Wallet_Recharge_' . $recharge->cr_id . '.pdf');
    }
}

