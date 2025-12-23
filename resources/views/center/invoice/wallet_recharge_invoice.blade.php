@extends('center.layouts.base')
@section('title', 'Invoice - Wallet Recharge')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-end mb-3">
                        <a href="{{ route('center.invoice.wallet_recharge_download', $recharge->cr_id) }}" class="btn btn-primary">
                            <i class="fa-solid fa-download"></i> Download PDF
                        </a>
                    </div>
                    @include('center.invoice.wallet_recharge_invoice_pdf', ['invoice_no' => 'INV-WLT-' . str_pad($recharge->cr_id, 6, '0', STR_PAD_LEFT), 'invoice_date' => date('d-M-Y', strtotime($recharge->created_at))])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

