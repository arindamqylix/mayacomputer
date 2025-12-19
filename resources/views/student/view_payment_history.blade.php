@extends('student.layouts.base')
@section('title', 'Payment History')
@push('custom-css')
<style>
	/* Modern Card Header */
	.payment-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.payment-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.payment-header h4 i {
		font-size: 1.75rem;
	}
	
	/* Modern Card */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	/* Modern Table */
	.modern-table {
		margin: 0;
	}
	
	.modern-table thead th {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.75rem;
		letter-spacing: 0.5px;
		padding: 1rem;
		border: none;
		white-space: nowrap;
	}
	
	.modern-table tbody td {
		padding: 1rem;
		vertical-align: middle;
		border-bottom: 1px solid #f0f0f0;
	}
	
	.modern-table tbody tr {
		transition: all 0.3s ease;
	}
	
	.modern-table tbody tr:hover {
		background-color: #f8f9ff;
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
	}
	
	/* Amount Badge */
	.amount-badge {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		display: inline-block;
	}
	
	.total-amount {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
	}
	
	/* Date Display */
	.date-display {
		color: #495057;
		font-weight: 500;
		font-family: 'Courier New', monospace;
	}
	
	/* Empty State */
	.empty-state {
		text-align: center;
		padding: 3rem;
		color: #6c757d;
	}
	
	.empty-state i {
		font-size: 4rem;
		margin-bottom: 1rem;
		opacity: 0.5;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
    <div class="col-12">
        <div class="card modern-card">
            <div class="card-header payment-header">
                <h4>
                    <i class="fas fa-credit-card"></i>
                    Payment History
                </h4>
            </div>
            <div class="card-body p-0">
                @if(isset($payment_list) && count($payment_list) > 0)
                    <div class="table-responsive">
                        <table class="table modern-table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-calendar me-2"></i>Paid Date</th>
                                    <th><i class="fas fa-money-bill-wave me-2"></i>Total Amount</th>
                                    <th><i class="fas fa-check-circle me-2"></i>Paid Amount</th>
                                    <th><i class="fas fa-comment me-2"></i>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment_list as $data)
                                    <tr>
                                        <td>
                                            <span class="date-display">
                                                @if($data->fp_date)
                                                    {{ \Carbon\Carbon::parse($data->fp_date)->format('d M, Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <span class="amount-badge total-amount">
                                                ₹{{ number_format($data->fp_total_amount ?? 0, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="amount-badge">
                                                ₹{{ number_format($data->fp_amount ?? 0, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $data->fp_remarks ?? 'N/A' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-receipt"></i>
                        <h5>No Payment Records Found</h5>
                        <p>Your payment history will appear here once you make a payment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
