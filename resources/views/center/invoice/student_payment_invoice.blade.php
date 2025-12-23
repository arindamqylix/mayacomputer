@extends('center.layouts.base')
@section('title', 'Invoice - Student Payment')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-end mb-3">
                        <a href="{{ route('center.invoice.student_payment_download', $payment->fp_id) }}" class="btn btn-primary">
                            <i class="fa-solid fa-download"></i> Download PDF
                        </a>
                    </div>
                    @include('center.invoice.student_payment_invoice_pdf', ['invoice_no' => $payment->fp_receipt_no, 'invoice_date' => date('d-M-Y', strtotime($payment->fp_date))])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

