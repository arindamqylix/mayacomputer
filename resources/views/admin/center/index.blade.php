@extends('admin.layouts.base')
@section('title', 'Center List')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header */
	.center-list-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.center-list-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.center-list-header h4 i {
		font-size: 1.75rem;
	}
	
	/* Modern Card */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	/* Search Section */
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
		border-color: #2563eb;
		box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
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
	
	/* Status Badges */
	.status-badge {
		padding: 0.5rem 1rem;
		border-radius: 50px;
		font-size: 0.75rem;
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		display: inline-block;
	}
	
	.status-active {
		background-color: #d1ecf1;
		color: #0c5460;
	}
	
	.status-pending {
		background-color: #fff3cd;
		color: #856404;
	}
	
	.status-approved {
		background-color: #d4edda;
		color: #155724;
	}
	
	.status-blocked {
		background-color: #f8d7da;
		color: #721c24;
	}
	
	/* Center Code */
	.center-code {
		font-family: 'Courier New', monospace;
		font-weight: 600;
		color: #495057;
		background: #f8f9fa;
		padding: 0.25rem 0.5rem;
		border-radius: 0.25rem;
	}
	
	/* Balance Badge */
	.balance-badge {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 0.375rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		display: inline-block;
	}
	
	/* Action Select */
	.action-select {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.5rem 1rem;
		font-size: 0.875rem;
		transition: all 0.3s ease;
		background-color: white;
		cursor: pointer;
		margin-bottom: 0.5rem;
		width: 100%;
	}
	
	.action-select:focus {
		border-color: #2563eb;
		box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
		outline: none;
	}
	
	/* Action Buttons */
	.action-btn {
		border-radius: 0.375rem;
		padding: 0.5rem 0.75rem;
		margin: 0 0.25rem;
		transition: all 0.3s ease;
		border: none;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	}
	
	.action-btn:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
	}
	
	.action-btn-edit {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
	}
	
	.action-btn-edit:hover {
		background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
		color: white;
	}
	
	.action-btn-certificate {
		background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
		color: white;
	}
	
	.action-btn-certificate:hover {
		background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%);
		color: white;
	}
	
	.action-btn-idcard {
		background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
		color: #000077;
	}
	
	.action-btn-idcard:hover {
		background: linear-gradient(135deg, #ffed4e 0%, #ffd700 100%);
		color: #000077;
	}
	
	.action-btn-delete {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
	}
	
	.action-btn-delete:hover {
		background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
		color: white;
	}
	
	/* Add Button */
	.btn-add-center {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
	}
	
	.btn-add-center:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
	}
	
	/* Email Link */
	.email-link {
		color: #2563eb;
		text-decoration: none;
		transition: all 0.3s ease;
	}
	
	.email-link:hover {
		color: #1e40af;
		text-decoration: underline;
	}
	
	/* Mobile Number */
	.mobile-number {
		font-family: 'Courier New', monospace;
		font-weight: 600;
		color: #495057;
	}
	
	/* Address */
	.address-text {
		color: #6c757d;
		font-size: 0.875rem;
		max-width: 200px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	
	/* Responsive */
	@media (max-width: 768px) {
		.center-list-header h4 {
			font-size: 1.25rem;
		}
		
		.modern-table thead th,
		.modern-table tbody td {
			padding: 0.75rem 0.5rem;
			font-size: 0.875rem;
		}
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card modern-card">
			<!-- Modern Header -->
			<div class="card-header center-list-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-building"></i>
						Center List
					</h4>
					<a href="{{ route('add_center') }}">
						<button class="btn btn-add-center text-white">
							<i class="fas fa-plus-circle me-2"></i>
							Add New Center
						</button>
					</a>
				</div>
			</div>
			
			<!-- Search Section -->
			<div class="search-section">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="search-input-wrapper">
							<i class="fas fa-search"></i>
							<input type="text" id="searchInput" class="form-control" placeholder="Search by center name, code, director, email, or mobile...">
						</div>
					</div>
					<div class="col-md-6 text-end">
						<span class="text-muted">
							<i class="fas fa-info-circle me-1"></i>
							Total Centers: <strong>{{ count($center) }}</strong>
						</span>
					</div>
				</div>
			</div>
			
			<!-- Table Section -->
			<div class="card-body p-0">
				<div class="table-responsive">
					<table id="datatable-buttons" class="table modern-table table-hover w-100">
						<thead>
							<tr>
								<th><i class="fas fa-hashtag me-2"></i>Center Code</th>
								<th><i class="fas fa-building me-2"></i>Center Name</th>
								<th><i class="fas fa-user-tie me-2"></i>Director Name</th>
								<th><i class="fas fa-map-marker-alt me-2"></i>Address</th>
								<th><i class="fas fa-envelope me-2"></i>Email</th>
								<th><i class="fas fa-phone me-2"></i>Mobile</th>
								<th><i class="fas fa-wallet me-2"></i>Balance</th>
								<th><i class="fas fa-info-circle me-2"></i>Status</th>
								<th><i class="fas fa-tools me-2"></i>Action</th>
							</tr>
						</thead>
						<tbody>
							@php $i=1; @endphp
							@foreach($center as $data)
								<tr>
									<td>
										<span class="center-code">{{ $data->cl_code }}</span>
									</td>
									<td>
										<strong>{{ $data->cl_center_name ?? 'N/A' }}</strong>
									</td>
									<td>{{ $data->cl_director_name ?? 'N/A' }}</td>
									<td>
										<span class="address-text" title="{{ $data->cl_center_address ?? 'N/A' }}">
											{{ $data->cl_center_address ?? 'N/A' }}
										</span>
									</td>
									<td>
										<a href="mailto:{{ $data->cl_email }}" class="email-link">
											{{ $data->cl_email ?? 'N/A' }}
										</a>
									</td>
									<td>
										<span class="mobile-number">{{ $data->cl_mobile ?? 'N/A' }}</span>
									</td>
									<td>
										<span class="balance-badge">
											₹{{ number_format($data->cl_wallet_balance ?? 0, 2) }}
										</span>
									</td>
									<td>
										@php
											$status = strtolower($data->cl_account_status ?? 'pending');
										@endphp
										<span class="status-badge status-{{ $status }}">
											{{ $data->cl_account_status ?? 'PENDING' }}
										</span>
									</td>
									<td>
										<div class="d-flex flex-column align-items-start">
											<select class="action-select" 
											        onchange="centerStatus({{ $data->cl_code }}, this.value);"
											        data-current-status="{{ $data->cl_account_status ?? 'PENDING' }}">
												<option value="">--Select Status--</option>
												<option value="ACTIVE" {{ ($data->cl_account_status ?? '') == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
												<option value="PENDING" {{ ($data->cl_account_status ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
												<option value="APPROVED" {{ ($data->cl_account_status ?? '') == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
												<option value="BLOCKED" {{ ($data->cl_account_status ?? '') == 'BLOCKED' ? 'selected' : '' }}>BLOCKED</option>
											</select>
											<div class="mt-2">
												<a href="{{ route('edit_center', $data->cl_id) }}" 
												   title="Edit Center" 
												   class="btn btn-sm action-btn action-btn-edit text-white">
													<i class="fas fa-edit"></i>
												</a>
												<a href="{{ route('view_center_certificate', $data->cl_id) }}" 
												   title="View Certificate" 
												   class="btn btn-sm action-btn action-btn-certificate text-white"
												   target="_blank">
													<i class="fas fa-certificate"></i>
												</a>
												<a href="{{ route('admin.view_center_id_card', $data->cl_id) }}" 
												   title="View ID Card" 
												   class="btn btn-sm action-btn action-btn-idcard"
												   target="_blank">
													<i class="fas fa-id-card"></i>
												</a>
												<a onclick="return confirm('Are you sure you want to delete this center?');" 
												   href="{{ route('delete_center', $data->cl_id) }}" 
												   class="btn btn-sm action-btn action-btn-delete text-white"
												   title="Delete Center">
													<i class="fas fa-trash-alt"></i>
												</a>
											</div>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script type="text/javascript">
	function centerStatus(center_code, center_status) {
		if (!center_status) {
			return;
		}
		
		$.ajax({
			url: "{{ route('center.status') }}",
			type: "get",
			data: {
				center_code: center_code,
				center_status: center_status
			},
			dataType: "json",
			beforeSend: function() {
				// Show loading indicator
				$('body').append('<div class="loading-overlay"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
			},
			success: function(response) {
				if (response.status == 1) {
					// Use toastr if available, otherwise alert
					if (typeof toastr !== 'undefined') {
						toastr.success(response.msg);
					} else {
						alert(response.msg);
					}
					setTimeout(function() {
						location.reload();
					}, 1000);
				} else {
					if (typeof toastr !== 'undefined') {
						toastr.error(response.msg);
					} else {
						alert(response.msg);
					}
				}
			},
			error: function(xhr, status, error) {
				if (typeof toastr !== 'undefined') {
					toastr.error('An error occurred. Please try again.');
				} else {
					alert('An error occurred. Please try again.');
				}
			},
			complete: function() {
				$('.loading-overlay').remove();
			}
		});
	}
	
	// Enhanced search functionality
	$(document).ready(function() {
		var table = $('#datatable-buttons').DataTable();
		
		// Custom search input
		$('#searchInput').on('keyup', function() {
			table.search(this.value).draw();
		});
	});
</script>
@endpush
