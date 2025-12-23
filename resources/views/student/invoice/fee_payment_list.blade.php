@extends('student.layouts.base')
@section('title', 'Fee Payment Invoices')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fa-solid fa-file-invoice"></i> Fee Payment Invoices
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Receipt No.</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $invoice)
                                    <tr>
                                        <td><strong>{{ $invoice->fp_receipt_no }}</strong></td>
                                        <td>₹ {{ number_format($invoice->fp_amount, 2) }}</td>
                                        <td>{{ date('d-M-Y', strtotime($invoice->fp_date)) }}</td>
                                        <td>
                                            <a href="{{ route('student.invoice.fee_payment_view', $invoice->fp_id) }}" class="btn btn-sm btn-info">
                                                <i class="fa-solid fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('student.invoice.fee_payment_download', $invoice->fp_id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-download"></i> Download PDF
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No invoices found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

