@extends('student.layouts.base')
@section('title', 'Reissue Documents')
@push('custom-css')
<style type="text/css">
	.reissue-header {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.reissue-header h4 {
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
	
	.request-form-card {
		background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
		border: 2px solid #e9ecef;
		border-radius: 0.5rem;
		padding: 2rem;
		margin-bottom: 2rem;
	}
	
	.form-group label {
		font-weight: 600;
		color: #495057;
		margin-bottom: 0.5rem;
		font-size: 0.95rem;
	}
	
	.form-select, .form-control {
		border-radius: 0.5rem;
		border: 2px solid #dee2e6;
		padding: 0.75rem 1rem;
		transition: all 0.3s ease;
	}
	
	.form-select:focus, .form-control:focus {
		border-color: #667eea;
		box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
	}
	
	.document-type-option {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 0.5rem;
	}
	
	.document-type-info {
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.document-type-price {
		font-weight: 700;
		color: #10b981;
		font-size: 1rem;
	}
	
	.btn-submit {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		padding: 0.875rem 2.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		border: none;
		transition: all 0.3s ease;
		font-size: 1rem;
	}
	
	.btn-submit:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
		color: white;
	}
	
	.price-display {
		background: linear-gradient(135deg, #10b981 0%, #059669 100%);
		color: white;
		padding: 1rem 1.5rem;
		border-radius: 0.5rem;
		margin-top: 1rem;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	
	.price-display.hidden {
		display: none;
	}
	
	.price-label {
		font-weight: 600;
		font-size: 1rem;
	}
	
	.price-amount {
		font-weight: 700;
		font-size: 1.5rem;
	}
	
	.request-table {
		width: 100%;
	}
	
	.request-table thead th {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		font-weight: 600;
		padding: 1rem;
		text-align: left;
		font-size: 0.875rem;
	}
	
	.request-table tbody td {
		padding: 1rem;
		border-bottom: 1px solid #e9ecef;
		vertical-align: middle;
	}
	
	.request-table tbody tr:hover {
		background-color: #f8f9ff;
	}
	
	.status-badge {
		padding: 0.5rem 1rem;
		border-radius: 50px;
		font-size: 0.75rem;
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
	
	.btn-view {
		background: #667eea;
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		text-decoration: none;
		font-size: 0.875rem;
		display: inline-block;
	}
	
	.btn-view:hover {
		background: #5568d3;
		color: white;
	}
	
	.btn-pay {
		background: #10b981;
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		text-decoration: none;
		font-size: 0.875rem;
		display: inline-block;
		margin-left: 0.5rem;
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
				<div class="reissue-header">
					<h4>
						<i class="fa-solid fa-file-circle-plus"></i>
						Reissue Documents
					</h4>
				</div>
				<div class="card-body p-4">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="fa-solid fa-check-circle"></i> {{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif
					
					@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<i class="fa-solid fa-exclamation-circle"></i> {{ session('error') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif
					
					@if(session('info'))
						<div class="alert alert-info alert-dismissible fade show" role="alert">
							<i class="fa-solid fa-info-circle"></i> {{ session('info') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif
					
					<!-- Request Form -->
					<div class="request-form-card">
						<h5 class="mb-4">
							<i class="fa-solid fa-file-circle-plus"></i> Request New Document Reissue
						</h5>
						
						<form action="{{ route('student.document_reissue.store') }}" method="POST" id="reissueForm">
							@csrf
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="document_type">
											<i class="fa-solid fa-file-lines"></i> Select Document Type <span class="text-danger">*</span>
										</label>
										<select class="form-select" id="document_type" name="document_type" required>
											<option value="">-- Select Document Type --</option>
											<option value="CERTIFICATE">Certificate - ₹ 500.00</option>
											<option value="MARKSHEET">Marksheet - ₹ 300.00</option>
											<option value="ID_CARD">ID Card - ₹ 200.00</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="remarks">
											<i class="fa-solid fa-comment"></i> Remarks (Optional)
										</label>
										<input type="text" class="form-control" id="remarks" name="remarks" 
											placeholder="Enter any additional information or reason...">
									</div>
								</div>
							</div>
							
							<div class="price-display hidden" id="priceDisplay">
								<div class="price-label">Total Amount:</div>
								<div class="price-amount" id="priceAmount">₹ 0.00</div>
							</div>
							
							<div class="mt-3">
								<button type="submit" class="btn-submit">
									<i class="fa-solid fa-paper-plane"></i> Submit Request & Proceed to Payment
								</button>
							</div>
						</form>
					</div>
					
					<hr class="my-4">
					
					<!-- My Requests -->
					<h5 class="mb-4">
						<i class="fa-solid fa-clock-rotate-left"></i> My Requests
					</h5>
					
					@if($requests->count() > 0)
						<div class="table-responsive">
							<table class="table request-table">
								<thead>
									<tr>
										<th>Request ID</th>
										<th>Document Type</th>
										<th>Amount</th>
										<th>Payment Status</th>
										<th>Request Status</th>
										<th>Requested Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($requests as $request)
										<tr>
											<td><strong>#{{ $request->drr_id }}</strong></td>
											<td>
												@if($request->drr_document_type == 'CERTIFICATE')
													<i class="fa-solid fa-certificate"></i> Certificate
												@elseif($request->drr_document_type == 'MARKSHEET')
													<i class="fa-solid fa-file-lines"></i> Marksheet
												@else
													<i class="fa-solid fa-id-card"></i> ID Card
												@endif
											</td>
											<td><strong>₹ {{ number_format($request->drr_amount, 2) }}</strong></td>
											<td>
												@if($request->drr_payment_status == 'PAID')
													<span class="status-badge status-paid">Paid</span>
												@elseif($request->drr_payment_status == 'FAILED')
													<span class="status-badge status-rejected">Failed</span>
												@else
													<span class="status-badge status-pending">Pending</span>
												@endif
											</td>
											<td>
												@if($request->drr_status == 'COMPLETED')
													<span class="status-badge status-completed">Completed</span>
												@elseif($request->drr_status == 'PROCESSING')
													<span class="status-badge status-processing">Processing</span>
												@elseif($request->drr_status == 'REJECTED')
													<span class="status-badge status-rejected">Rejected</span>
												@elseif($request->drr_status == 'PAID')
													<span class="status-badge status-paid">Paid</span>
												@else
													<span class="status-badge status-pending">Pending</span>
												@endif
											</td>
											<td>{{ \Carbon\Carbon::parse($request->drr_requested_at)->format('d M, Y') }}</td>
											<td>
												<a href="{{ route('student.document_reissue.show', $request->drr_id) }}" class="btn-view">
													<i class="fa-solid fa-eye"></i> View
												</a>
												@if($request->drr_payment_status == 'PENDING')
													<a href="{{ route('student.document_reissue.payment', $request->drr_id) }}" class="btn-pay">
														<i class="fa-solid fa-credit-card"></i> Pay
													</a>
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="alert alert-info text-center">
							<i class="fa-solid fa-info-circle"></i>
							No reissue requests found. Request a document reissue above.
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-script')
<script>
	$(document).ready(function() {
		// Document prices
		const prices = {
			'CERTIFICATE': 500.00,
			'MARKSHEET': 300.00,
			'ID_CARD': 200.00
		};
		
		// Update price display when document type changes
		$('#document_type').on('change', function() {
			const selectedType = $(this).val();
			const priceDisplay = $('#priceDisplay');
			const priceAmount = $('#priceAmount');
			
			if (selectedType && prices[selectedType]) {
				priceAmount.text('₹ ' + prices[selectedType].toFixed(2));
				priceDisplay.removeClass('hidden');
			} else {
				priceDisplay.addClass('hidden');
			}
		});
	});
</script>
@endpush
