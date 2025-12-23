@extends('admin.layouts.base')
@section('title', 'Invoice - Wallet Recharge')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-end mb-3">
                        <a href="{{ route('admin.invoice.center_recharge_download', $recharge->cr_id) }}" class="btn btn-primary">
                            <i class="fa-solid fa-download"></i> Download PDF
                        </a>
                    </div>
                    @include('admin.invoice.center_recharge_invoice_pdf', ['invoice_no' => $invoice_no, 'invoice_date' => $invoice_date])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

