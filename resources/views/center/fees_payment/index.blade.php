@extends('center.layouts.base')
@section('title', 'Pay Fee')
@push('custom-css')
<style type="text/css">
	/* Modern Card Header - Matching Logo Blue */
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
		margin-bottom: 2rem;
	}
	
	/* Student Info Card */
	.student-info-card {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border-radius: 12px;
		padding: 1.5rem;
		margin-bottom: 2rem;
		box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
	}
	
	.student-info-card h5 {
		margin: 0;
		font-weight: 600;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		font-size: 1.25rem;
	}
	
	.student-info-card h5 i {
		font-size: 1.5rem;
	}
	
	/* Form Section */
	.form-section {
		background: #fff;
		border-radius: 12px;
		padding: 2rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		border: 1px solid #e5e7eb;
		height: fit-content;
	}
	
	.form-section h5 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		padding-bottom: 1rem;
		border-bottom: 2px solid #e5e7eb;
	}
	
	.form-section h5 i {
		color: #2563eb;
		font-size: 1.25rem;
	}
	
	.form-group label {
		font-weight: 600;
		color: #374151;
		margin-bottom: 0.5rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 0.9375rem;
	}
	
	.form-group label i {
		color: #2563eb;
		font-size: 0.875rem;
	}
	
	.form-control {
		border: 2px solid #e5e7eb;
		border-radius: 8px;
		padding: 0.75rem 1rem;
		font-size: 0.9375rem;
		transition: all 0.3s ease;
		color: #1e3a8a;
	}
	
	.form-control:focus {
		border-color: #2563eb;
		outline: none;
		box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
	}
	
	.form-control[readonly] {
		background: #f8f9fa;
		font-weight: 600;
		color: #1e3a8a;
	}
	
	.btn-make-payment {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 1rem;
		width: 100%;
		transition: all 0.3s ease;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 0.5rem;
	}
	
	.btn-make-payment:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.4);
	}
	
	.btn-make-payment:active {
		transform: translateY(0);
	}
	
	/* Payment History Section */
	.payment-history-section {
		background: #fff;
		border-radius: 12px;
		padding: 2rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		border: 1px solid #e5e7eb;
	}
	
	.payment-history-section h5 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		padding-bottom: 1rem;
		border-bottom: 2px solid #e5e7eb;
	}
	
	.payment-history-section h5 i {
		color: #2563eb;
		font-size: 1.25rem;
	}
	
	/* Enhanced Table */
	.modern-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
	}
	
	.modern-table thead {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
	}
	
	.modern-table thead th {
		color: white;
		font-weight: 600;
		padding: 1rem;
		text-align: left;
		border: none;
		font-size: 0.875rem;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	
	.modern-table thead th:first-child {
		border-top-left-radius: 8px;
	}
	
	.modern-table thead th:last-child {
		border-top-right-radius: 8px;
	}
	
	.modern-table tbody tr {
		transition: all 0.2s ease;
		border-bottom: 1px solid #e5e7eb;
	}
	
	.modern-table tbody tr:hover {
		background: linear-gradient(90deg, #f8f9ff 0%, #ffffff 100%);
		transform: scale(1.01);
		box-shadow: 0 2px 8px rgba(0,0,0,0.05);
	}
	
	.modern-table tbody td {
		padding: 1rem;
		color: #374151;
		font-size: 0.875rem;
		vertical-align: middle;
	}
	
	/* Date Display */
	.date-display {
		color: #495057;
		font-weight: 500;
		font-family: 'Courier New', monospace;
		font-size: 0.875rem;
	}
	
	/* Amount Display */
	.amount-display {
		font-weight: 600;
		font-size: 0.9375rem;
		color: #11998e;
	}
	
	/* Remarks */
	.remarks-text {
		color: #495057;
		font-size: 0.875rem;
	}
	
	/* Empty State */
	.empty-state {
		text-align: center;
		padding: 3rem 2rem;
		color: #6c757d;
	}
	
	.empty-state i {
		font-size: 3rem;
		margin-bottom: 1rem;
		opacity: 0.5;
		color: #2563eb;
	}
	
	.empty-state h6 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 0.5rem;
	}
	
	.empty-state p {
		color: #6b7280;
		font-size: 0.875rem;
	}
	
	/* Success Alert */
	.alert-success-custom {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		border-radius: 8px;
		padding: 1rem 1.5rem;
		margin-bottom: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		font-weight: 500;
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.3);
	}
	
	.alert-success-custom i {
		font-size: 1.25rem;
	}
	
	/* Fee Summary Cards */
	.fee-summary {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 1rem;
		margin-bottom: 1.5rem;
	}
	
	.fee-summary-card {
		background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
		border: 2px solid #e5e7eb;
		border-radius: 8px;
		padding: 1rem;
		text-align: center;
	}
	
	.fee-summary-card.total-fee {
		border-color: #2563eb;
	}
	
	.fee-summary-card.total-paid {
		border-color: #11998e;
	}
	
	.fee-summary-card.dues {
		border-color: #f5576c;
	}
	
	.fee-summary-card label {
		font-size: 0.75rem;
		color: #6b7280;
		font-weight: 500;
		margin-bottom: 0.5rem;
		display: block;
	}
	
	.fee-summary-card .amount {
		font-size: 1.25rem;
		font-weight: 700;
		color: #1e3a8a;
	}
	
	.fee-summary-card.total-fee .amount {
		color: #2563eb;
	}
	
	.fee-summary-card.total-paid .amount {
		color: #11998e;
	}
	
	.fee-summary-card.dues .amount {
		color: #f5576c;
	}
</style>
@endpush
@section('content')

<!-- Success Message -->
@if(session('success'))
	<div class="alert-success-custom">
		<i class="fas fa-check-circle"></i>
		<span>{{ session('success') }}</span>
	</div>
@endif

<!-- Student Info Card -->
<div class="student-info-card">
	<h5>
		<i class="fas fa-user-graduate"></i>
		Pay Fee for {{ $student->sl_name }}
	</h5>
</div>

<!-- Fee Summary Cards -->
@php
	$totalFee = $student->sf_amount ?? 0;
	$totalPaid = $student->sf_paid ?? 0;
	$dues = $student->sf_due ?? 0;
@endphp
<div class="fee-summary">
	<div class="fee-summary-card total-fee">
		<label>Total Fee</label>
		<div class="amount">₹{{ number_format($totalFee, 2) }}</div>
	</div>
	<div class="fee-summary-card total-paid">
		<label>Total Paid</label>
		<div class="amount">₹{{ number_format($totalPaid, 2) }}</div>
	</div>
	<div class="fee-summary-card dues">
		<label>Dues Amount</label>
		<div class="amount">₹{{ number_format($dues, 2) }}</div>
	</div>
</div>

<!-- Main Card -->
<div class="card modern-card">
	<div class="payment-header">
		<h4>
			<i class="fas fa-money-bill-wave"></i>
			Payment Details
		</h4>
	</div>
	<div class="card-body" style="padding: 2rem;">
		<div class="row">
			<!-- Payment Form -->
			<div class="col-lg-4">
				<div class="form-section">
					<h5>
						<i class="fas fa-plus-circle"></i>
						Make Payment
					</h5>
					<form method="POST" action="{{ route('fees_payment') }}">
						@csrf
						<input type="hidden" name="student_id" value="{{ request()->get('student_id') }}">
						
						<div class="form-group mb-3">
							<label for="paid_date">
								<i class="fas fa-calendar"></i>
								Date of Payment
							</label>
							<input 
								required 
								class="form-control" 
								name="paid_date" 
								id="paid_date"
								type="date"
								value="{{ date('Y-m-d') }}"
							>
						</div>
						
						<div class="form-group mb-3">
							<label for="total_amount">
								<i class="fas fa-rupee-sign"></i>
								Total Dues Amount
							</label>
							<input 
								class="form-control" 
								value="{{ $dues }}" 
								name="total_amount" 
								id="total_amount"
								type="text" 
								readonly
							>
						</div>
						
						<div class="form-group mb-3">
							<label for="paid_amount">
								<i class="fas fa-money-bill"></i>
								Enter Amount to Pay
							</label>
							<input 
								type="number" 
								class="form-control" 
								id="paid_amount"
								name="paid_amount" 
								required
								min="0"
								max="{{ $dues }}"
								step="0.01"
								placeholder="Enter payment amount"
							>
							<small class="text-muted">Maximum: ₹{{ number_format($dues, 2) }}</small>
						</div>
						
						<div class="form-group mb-3">
							<label for="remarks">
								<i class="fas fa-comment"></i>
								Remarks (About Fee)
							</label>
							<input 
								class="form-control" 
								name="remarks" 
								id="remarks"
								required
								placeholder="Payment remarks or notes"
							>
						</div>
						
						<button type="submit" class="btn-make-payment">
							<i class="fas fa-check-circle"></i>
							Make A Payment
						</button>
					</form>
				</div>
			</div>
			
			<!-- Payment History -->
			<div class="col-lg-8">
				<div class="payment-history-section">
					<h5>
						<i class="fas fa-history"></i>
						Payment History
					</h5>
					
					@if(count($payment_list) > 0)
						<div class="table-responsive">
							<table class="table modern-table">
								<thead>
									<tr>
										<th>Paid Date</th>
										<th>Total Amount</th>
										<th>Paid Amount</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									@foreach($payment_list as $data)
										<tr>
											<td>
												<span class="date-display">{{ \Carbon\Carbon::parse($data->fp_date)->format('d M, Y') }}</span>
											</td>
											<td>
												<span class="amount-display">₹{{ number_format($data->fp_total_amount, 2) }}</span>
											</td>
											<td>
												<span class="amount-display">₹{{ number_format($data->fp_amount, 2) }}</span>
											</td>
											<td>
												<span class="remarks-text">{{ $data->fp_remarks }}</span>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="empty-state">
							<i class="fas fa-receipt"></i>
							<h6>No Payment History</h6>
							<p>No previous payments found for this student.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Set max amount validation
		var maxAmount = parseFloat($('#total_amount').val());
		$('#paid_amount').on('input', function() {
			var enteredAmount = parseFloat($(this).val());
			if (enteredAmount > maxAmount) {
				$(this).val(maxAmount);
				alert('Payment amount cannot exceed the dues amount of ₹' + maxAmount.toFixed(2));
			}
		});
	});
</script>
@endpush
