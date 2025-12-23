@extends('admin.layouts.base')
@section('title', 'Center Wallet Recharge Invoices')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fa-solid fa-file-invoice"></i> Center Wallet Recharge Invoices
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Center Name</th>
                                    <th>Center Code</th>
                                    <th>Amount</th>
                                    <th>Payment ID</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $invoice)
                                    <tr>
                                        <td><strong>INV-WLT-{{ str_pad($invoice->cr_id, 6, '0', STR_PAD_LEFT) }}</strong></td>
                                        <td>{{ $invoice->center->cl_center_name ?? 'N/A' }}</td>
                                        <td>{{ $invoice->center->cl_code ?? 'N/A' }}</td>
                                        <td>₹ {{ number_format($invoice->cr_amount, 2) }}</td>
                                        <td>{{ $invoice->cr_razorpay_id ?? $invoice->cr_payment_id }}</td>
                                        <td>{{ date('d-M-Y', strtotime($invoice->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('admin.invoice.center_recharge_view', $invoice->cr_id) }}" class="btn btn-sm btn-info">
                                                <i class="fa-solid fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('admin.invoice.center_recharge_download', $invoice->cr_id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-download"></i> Download PDF
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No invoices found.</td>
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

