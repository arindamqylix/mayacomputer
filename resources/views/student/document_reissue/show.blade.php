@extends('student.layouts.base')
@section('title', 'Request Details')
@push('custom-css')
<style type="text/css">
	.detail-header {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.detail-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	.detail-card {
		background: #f8f9fa;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-bottom: 1.5rem;
	}
	
	.detail-row {
		display: flex;
		justify-content: space-between;
		padding: 0.75rem 0;
		border-bottom: 1px solid #e9ecef;
	}
	
	.detail-row:last-child {
		border-bottom: none;
	}
	
	.detail-label {
		font-weight: 600;
		color: #495057;
	}
	
	.detail-value {
		color: #212529;
	}
	
	.status-badge {
		padding: 0.5rem 1rem;
		border-radius: 50px;
		font-size: 0.875rem;
		font-weight: 600;
		display: inline-block;
	}
	
	.status-pending {
		background-color: #fff3cd;
		color: #856404;
	}
	
	.status-paid {
		background-color: #d1ecf1;
		color: #0c5460;
	}
	
	.status-processing {
		background-color: #d4edda;
		color: #155724;
	}
	
	.status-completed {
		background-color: #d1fae5;
		color: #065f46;
	}
	
	.status-rejected {
		background-color: #fee2e2;
		color: #991b1b;
	}
	
	.btn-back {
		background: #6c757d;
		color: white;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		text-decoration: none;
		margin-bottom: 1rem;
		display: inline-block;
	}
	
	.btn-back:hover {
		background: #5a6268;
		color: white;
	}
	
	.btn-pay {
		background: #10b981;
		color: white;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		text-decoration: none;
		display: inline-block;
	}
	
	.btn-pay:hover {
		background: #059669;
		color: white;
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="detail-header">
					<h4>
						<i class="fa-solid fa-file-circle-info"></i>
						Request Details
					</h4>
				</div>
				<div class="card-body p-4">
					<a href="{{ route('student.document_reissue') }}" class="btn-back">
						<i class="fa-solid fa-arrow-left"></i> Back to Requests
					</a>
					
					<div class="detail-card">
						<h5 class="mb-3">Request Information</h5>
						
						<div class="detail-row">
							<span class="detail-label">Request ID:</span>
							<span class="detail-value"><strong>#{{ $reissueRequest->drr_id }}</strong></span>
						</div>
						
						<div class="detail-row">
							<span class="detail-label">Document Type:</span>
							<span class="detail-value">
								@if($reissueRequest->drr_document_type == 'CERTIFICATE')
									<i class="fa-solid fa-certificate"></i> Certificate
								@elseif($reissueRequest->drr_document_type == 'MARKSHEET')
									<i class="fa-solid fa-file-lines"></i> Marksheet
								@else
									<i class="fa-solid fa-id-card"></i> ID Card
								@endif
							</span>
						</div>
						
						<div class="detail-row">
							<span class="detail-label">Amount:</span>
							<span class="detail-value"><strong>₹ {{ number_format($reissueRequest->drr_amount, 2) }}</strong></span>
						</div>
						
						<div class="detail-row">
							<span class="detail-label">Payment Status:</span>
							<span class="detail-value">
								@if($reissueRequest->drr_payment_status == 'PAID')
									<span class="status-badge status-paid">Paid</span>
								@elseif($reissueRequest->drr_payment_status == 'FAILED')
									<span class="status-badge status-rejected">Failed</span>
								@else
									<span class="status-badge status-pending">Pending</span>
								@endif
							</span>
						</div>
						
						<div class="detail-row">
							<span class="detail-label">Request Status:</span>
							<span class="detail-value">
								@if($reissueRequest->drr_status == 'COMPLETED')
									<span class="status-badge status-completed">Completed</span>
								@elseif($reissueRequest->drr_status == 'PROCESSING')
									<span class="status-badge status-processing">Processing</span>
								@elseif($reissueRequest->drr_status == 'REJECTED')
									<span class="status-badge status-rejected">Rejected</span>
								@elseif($reissueRequest->drr_status == 'PAID')
									<span class="status-badge status-paid">Paid</span>
								@else
									<span class="status-badge status-pending">Pending</span>
								@endif
							</span>
						</div>
						
						<div class="detail-row">
							<span class="detail-label">Requested Date:</span>
							<span class="detail-value">{{ \Carbon\Carbon::parse($reissueRequest->drr_requested_at)->format('d M, Y h:i A') }}</span>
						</div>
						
						@if($reissueRequest->drr_payment_id)
						<div class="detail-row">
							<span class="detail-label">Payment ID:</span>
							<span class="detail-value">{{ $reissueRequest->drr_payment_id }}</span>
						</div>
						@endif
						
						@if($reissueRequest->drr_processed_at)
						<div class="detail-row">
							<span class="detail-label">Processed Date:</span>
							<span class="detail-value">{{ \Carbon\Carbon::parse($reissueRequest->drr_processed_at)->format('d M, Y h:i A') }}</span>
						</div>
						@endif
						
						@if($reissueRequest->drr_remarks)
						<div class="detail-row">
							<span class="detail-label">Remarks:</span>
							<span class="detail-value">{{ $reissueRequest->drr_remarks }}</span>
						</div>
						@endif
						
						@if($reissueRequest->drr_admin_remarks)
						<div class="detail-row">
							<span class="detail-label">Admin Remarks:</span>
							<span class="detail-value">{{ $reissueRequest->drr_admin_remarks }}</span>
						</div>
						@endif
					</div>
					
					@if($reissueRequest->drr_payment_status == 'PENDING')
						<div class="text-center mt-3">
							<a href="{{ route('student.document_reissue.payment', $reissueRequest->drr_id) }}" class="btn-pay">
								<i class="fa-solid fa-credit-card"></i> Complete Payment
							</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

