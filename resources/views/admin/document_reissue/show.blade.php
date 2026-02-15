@extends('admin.layouts.base')
@section('title', 'Manage Document Re-Print Request')
@push('custom-css')
	<style type="text/css">
		.manage-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			border: none;
			padding: 1.5rem;
			border-radius: 0.5rem 0.5rem 0 0;
		}

		.manage-header h4 {
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

		.info-card {
			background: #f8f9fa;
			border-radius: 0.5rem;
			padding: 1.5rem;
			margin-bottom: 2rem;
			border-left: 4px solid #667eea;
		}

		.info-row {
			display: flex;
			justify-content: space-between;
			padding: 0.75rem 0;
			border-bottom: 1px solid #e9ecef;
		}

		.info-row:last-child {
			border-bottom: none;
		}

		.info-label {
			font-weight: 600;
			color: #495057;
		}

		.info-value {
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

		.status-failed {
			background-color: #fee2e2;
			color: #991b1b;
		}

		.action-card {
			background: white;
			border: 2px solid #e9ecef;
			border-radius: 0.5rem;
			padding: 1.5rem;
			margin-bottom: 1.5rem;
		}

		.btn-action {
			padding: 0.75rem 1.5rem;
			border-radius: 0.5rem;
			font-weight: 600;
			border: none;
			margin-right: 0.5rem;
			margin-bottom: 0.5rem;
			transition: all 0.3s ease;
		}

		.btn-approve {
			background: #10b981;
			color: white;
		}

		.btn-approve:hover {
			background: #059669;
			color: white;
		}

		.btn-complete {
			background: #3b82f6;
			color: white;
		}

		.btn-complete:hover {
			background: #2563eb;
			color: white;
		}

		.btn-reject {
			background: #ef4444;
			color: white;
		}

		.btn-reject:hover {
			background: #dc2626;
			color: white;
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

		.form-group label {
			font-weight: 600;
			color: #495057;
			margin-bottom: 0.5rem;
		}

		.form-control,
		.form-select {
			border-radius: 0.5rem;
			border: 1px solid #dee2e6;
			padding: 0.75rem 1rem;
		}

		.form-control:focus,
		.form-select:focus {
			border-color: #667eea;
			box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
		}
	</style>
@endpush

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="modern-card">
					<div class="manage-header">
						<h4>
							<i class="fa-solid fa-file-circle-check"></i>
							Manage Document Re-Print Request
						</h4>
					</div>
					<div class="card-body p-4">
						<a href="{{ route('admin.document_reissue.index') }}" class="btn-back">
							<i class="fa-solid fa-arrow-left"></i> Back to List
						</a>

						@if(session('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{ session('success') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							</div>
						@endif

						@if(session('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								{{ session('error') }}
								<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							</div>
						@endif

						<div class="info-card">
							<h5 class="mb-3">Request Information</h5>

							<div class="info-row">
								<span class="info-label">Request ID:</span>
								<span class="info-value"><strong>#{{ $request->drr_id }}</strong></span>
							</div>

							<div class="info-row">
								<span class="info-label">Document Type:</span>
								<span class="info-value">
									@php
										$dt = strtolower($request->drr_document_type ?? '');
										$icon = 'id-card';
										if (str_contains($dt, 'certificate')) $icon = 'certificate';
										elseif (str_contains($dt, 'marksheet') || str_contains($dt, 'result')) $icon = 'file-lines';
									@endphp
									<i class="fa-solid fa-{{ $icon }}"></i> {{ $request->drr_document_type }}
								</span>
							</div>

							<div class="info-row">
								<span class="info-label">Student Name:</span>
								<span class="info-value">{{ $request->sl_name ?? 'N/A' }}</span>
							</div>

							<div class="info-row">
								<span class="info-label">Registration No:</span>
								<span class="info-value">{{ $request->sl_reg_no ?? 'N/A' }}</span>
							</div>

							<div class="info-row">
								<span class="info-label">Email:</span>
								<span class="info-value">{{ $request->sl_email ?? 'N/A' }}</span>
							</div>

							<div class="info-row">
								<span class="info-label">Mobile:</span>
								<span class="info-value">{{ $request->sl_mobile_no ?? 'N/A' }}</span>
							</div>

							<div class="info-row">
								<span class="info-label">Center:</span>
								<span class="info-value">{{ $request->cl_center_name ?? 'N/A' }}
									({{ $request->cl_code ?? 'N/A' }})</span>
							</div>

							<div class="info-row">
								<span class="info-label">Amount:</span>
								<span class="info-value"><strong>₹
										{{ number_format($request->drr_amount, 2) }}</strong></span>
							</div>

							<div class="info-row">
								<span class="info-label">Payment Status:</span>
								<span class="info-value">
									@if($request->drr_payment_status == 'PAID')
										<span class="status-badge status-paid">Paid</span>
									@elseif($request->drr_payment_status == 'FAILED')
										<span class="status-badge status-failed">Failed</span>
									@else
										<span class="status-badge status-pending">Pending</span>
									@endif
								</span>
							</div>

							<div class="info-row">
								<span class="info-label">Request Status:</span>
								<span class="info-value">
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
								</span>
							</div>

							<div class="info-row">
								<span class="info-label">Requested Date:</span>
								<span
									class="info-value">{{ \Carbon\Carbon::parse($request->drr_requested_at)->format('d M, Y h:i A') }}</span>
							</div>

							@if($request->drr_payment_id)
								<div class="info-row">
									<span class="info-label">Payment ID:</span>
									<span class="info-value">{{ $request->drr_payment_id }}</span>
								</div>
							@endif

							@if($request->drr_processed_at)
								<div class="info-row">
									<span class="info-label">Processed Date:</span>
									<span
										class="info-value">{{ \Carbon\Carbon::parse($request->drr_processed_at)->format('d M, Y h:i A') }}</span>
								</div>
							@endif

							@if($request->drr_remarks)
								<div class="info-row">
									<span class="info-label">Student Remarks:</span>
									<span class="info-value">{{ $request->drr_remarks }}</span>
								</div>
							@endif

							@if($request->drr_admin_remarks)
								<div class="info-row">
									<span class="info-label">Admin Remarks:</span>
									<span class="info-value">{{ $request->drr_admin_remarks }}</span>
								</div>
							@endif
						</div>

						<!-- Action Card -->
						<div class="action-card">
							<h5 class="mb-3">Update Request Status</h5>

							<form action="{{ route('admin.document_reissue.update_status', $request->drr_id) }}"
								method="POST" class="mb-3">
								@csrf
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="status">Status</label>
											<select class="form-select" id="status" name="status" required>
												<option value="PENDING" {{ $request->drr_status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
												<option value="PAID" {{ $request->drr_status == 'PAID' ? 'selected' : '' }}>
													PAID</option>
												<option value="PROCESSING" {{ $request->drr_status == 'PROCESSING' ? 'selected' : '' }}>PROCESSING</option>
												<option value="COMPLETED" {{ $request->drr_status == 'COMPLETED' ? 'selected' : '' }}>COMPLETED</option>
												<option value="REJECTED" {{ $request->drr_status == 'REJECTED' ? 'selected' : '' }}>REJECTED</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="admin_remarks">Admin Remarks (Optional)</label>
											<textarea class="form-control" id="admin_remarks" name="admin_remarks" rows="2"
												placeholder="Add any remarks or notes...">{{ $request->drr_admin_remarks ?? '' }}</textarea>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label>&nbsp;</label>
											<button type="submit" class="btn btn-primary btn-action w-100">
												<i class="fa-solid fa-save"></i> Update
											</button>
										</div>
									</div>
								</div>
							</form>

							<hr>

							<h6 class="mb-3">Quick Actions</h6>
							<div class="d-flex flex-wrap">
								@if($request->drr_payment_status == 'PAID' && $request->drr_status != 'PROCESSING' && $request->drr_status != 'COMPLETED' && $request->drr_status != 'REJECTED')
									<a href="{{ route('admin.document_reissue.approve', $request->drr_id) }}"
										class="btn-action btn-approve"
										onclick="return confirm('Are you sure you want to approve this request and mark it as processing?');">
										<i class="fa-solid fa-check"></i> Approve & Mark Processing
									</a>
								@endif

								@if($request->drr_status == 'PROCESSING' && $request->drr_status != 'COMPLETED')
									<a href="{{ route('admin.document_reissue.complete', $request->drr_id) }}"
										class="btn-action btn-complete"
										onclick="return confirm('Are you sure you want to mark this request as completed?');">
										<i class="fa-solid fa-check-circle"></i> Mark as Completed
									</a>
								@endif

								@if($request->drr_status != 'REJECTED' && $request->drr_status != 'COMPLETED')
									<button type="button" class="btn-action btn-reject" data-bs-toggle="modal"
										data-bs-target="#rejectModal">
										<i class="fa-solid fa-times-circle"></i> Reject Request
									</button>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Reject Modal -->
	<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{ route('admin.document_reissue.reject', $request->drr_id) }}" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title" id="rejectModalLabel">Reject Request</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="reject_remarks">Reason for Rejection <span class="text-danger">*</span></label>
							<textarea class="form-control" id="reject_remarks" name="admin_remarks" rows="4" required
								placeholder="Please provide a reason for rejecting this request..."></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-danger">
							<i class="fa-solid fa-times-circle"></i> Reject Request
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection