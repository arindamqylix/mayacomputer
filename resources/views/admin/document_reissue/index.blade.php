@extends('admin.layouts.base')
@section('title', 'Document Re-Print Requests')
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

		.modern-table thead th {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

		.modern-table tbody tr:hover {
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

		.status-failed {
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
			margin-right: 0.5rem;
		}

		.btn-view:hover {
			background: #5568d3;
			color: white;
		}

		.search-section {
			background: #f8f9fa;
			padding: 1.5rem;
			border-bottom: 1px solid #e9ecef;
		}

		.search-input-wrapper {
			position: relative;
		}

		.search-input-wrapper i {
			position: absolute;
			left: 15px;
			top: 50%;
			transform: translateY(-50%);
			color: #6c757d;
		}

		.search-input-wrapper input {
			padding-left: 45px;
			border-radius: 0.5rem;
			border: 1px solid #dee2e6;
			transition: all 0.3s ease;
		}

		.search-input-wrapper input:focus {
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
					<div class="reissue-header">
						<h4>
							<i class="fa-solid fa-file-circle-plus"></i>
							Document Re-Print Requests
						</h4>
					</div>

					<!-- Search Section -->
					<div class="search-section">
						<div class="row">
							<div class="col-md-6">
								<div class="search-input-wrapper">
									<i class="fas fa-search"></i>
									<input type="text" id="searchInput" class="form-control"
										placeholder="Search by request ID, student name, registration number...">
								</div>
							</div>
						</div>
					</div>

					<div class="card-body">
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

						@if($requests->count() > 0)
							<div class="table-responsive">
								<table class="table modern-table" id="reissueTable">
									<thead>
										<tr>
											<th>Request ID</th>
											<th>Student Name</th>
											<th>Registration No.</th>
											<th>Document Type</th>
											<th>Center</th>
											<th>Amount</th>
											<th>Payment Status</th>
											<th>Request Status</th>
											<th>Requested Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($requests as $req)
											<tr>
												<td><strong>#{{ $req->drr_id }}</strong></td>
												<td>{{ $req->sl_name ?? 'N/A' }}</td>
												<td>{{ $req->sl_reg_no ?? 'N/A' }}</td>
												<td>
													@if($req->drr_document_type == 'CERTIFICATE')
														<i class="fa-solid fa-certificate"></i> Certificate
													@elseif($req->drr_document_type == 'MARKSHEET')
														<i class="fa-solid fa-file-lines"></i> Marksheet
													@else
														<i class="fa-solid fa-id-card"></i> ID Card
													@endif
												</td>
												<td>
													{{ $req->cl_center_name ?? 'N/A' }}<br>
													<small class="text-muted">({{ $req->cl_code ?? 'N/A' }})</small>
												</td>
												<td><strong>₹ {{ number_format($req->drr_amount, 2) }}</strong></td>
												<td>
													@if($req->drr_payment_status == 'PAID')
														<span class="status-badge status-paid">Paid</span>
													@elseif($req->drr_payment_status == 'FAILED')
														<span class="status-badge status-failed">Failed</span>
													@else
														<span class="status-badge status-pending">Pending</span>
													@endif
												</td>
												<td>
													@if($req->drr_status == 'COMPLETED')
														<span class="status-badge status-completed">Completed</span>
													@elseif($req->drr_status == 'PROCESSING')
														<span class="status-badge status-processing">Processing</span>
													@elseif($req->drr_status == 'REJECTED')
														<span class="status-badge status-rejected">Rejected</span>
													@elseif($req->drr_status == 'PAID')
														<span class="status-badge status-paid">Paid</span>
													@else
														<span class="status-badge status-pending">Pending</span>
													@endif
												</td>
												<td>{{ \Carbon\Carbon::parse($req->drr_requested_at)->format('d M, Y') }}</td>
												<td>
													<a href="{{ route('admin.document_reissue.show', $req->drr_id) }}"
														class="btn-view">
														<i class="fa-solid fa-eye"></i> Manage
													</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						@else
							<div class="alert alert-info text-center">
								<i class="fa-solid fa-info-circle"></i>
								No document re-print requests found.
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
		$(document).ready(function () {
			// Search functionality
			$('#searchInput').on('keyup', function () {
				var value = $(this).val().toLowerCase();
				$('#reissueTable tbody tr').filter(function () {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
				});
			});
		});
	</script>
@endpush