@extends('admin.layouts.base')
@section('title', 'Courier Management')
@push('custom-css')
<style type="text/css">
	.courier-header {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.courier-header h4 {
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
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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
	
	.btn-dispatch {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-dispatch:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(245, 158, 11, 0.4);
		color: white;
	}

	.btn-view {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		margin-right: 0.5rem;
	}
	
	.btn-view:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(17, 153, 142, 0.4);
		color: white;
	}

	.badge-dispatched {
		background-color: #d1fae5;
		color: #065f46;
		padding: 0.25rem 0.75rem;
		border-radius: 0.25rem;
		font-size: 0.75rem;
		font-weight: 600;
	}

	.badge-pending {
		background-color: #fee2e2;
		color: #991b1b;
		padding: 0.25rem 0.75rem;
		border-radius: 0.25rem;
		font-size: 0.75rem;
		font-weight: 600;
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
		border-color: #f59e0b;
		box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="courier-header">
					<h4>
						<i class="fas fa-truck"></i>
						Courier Management
					</h4>
				</div>

				<!-- Search Section -->
				<div class="search-section">
					<div class="row">
						<div class="col-md-6">
							<div class="search-input-wrapper">
								<i class="fas fa-search"></i>
								<input type="text" id="searchInput" class="form-control" placeholder="Search by certificate no, student name, tracking number, courier name...">
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

					@if($certificates->count() > 0)
						<div class="table-responsive">
							<table class="table modern-table" id="courierTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Certificate No.</th>
										<th>Student Name</th>
										<th>Registration No.</th>
										<th>Course</th>
										<th>Center</th>
										<th>Dispatch Thru</th>
										<th>Dispatch Date</th>
										<th>Tracking Number</th>
										<th>Doc Qty</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($certificates as $cert)
										<tr>
											<td>{{ $i++ }}</td>
											<td><strong>{{ $cert->sc_certificate_number ?? 'N/A' }}</strong></td>
											<td>{{ $cert->sl_name ?? 'N/A' }}</td>
											<td>{{ $cert->sl_reg_no ?? 'N/A' }}</td>
											<td>{{ $cert->c_short_name ?? $cert->c_full_name ?? 'N/A' }}</td>
											<td>
												{{ $cert->cl_center_name ?? $cert->cl_name ?? 'N/A' }}<br>
												<small class="text-muted">({{ $cert->cl_code ?? 'N/A' }})</small>
											</td>
											<td>
												@if($cert->sc_dispatch_thru)
													<strong>{{ $cert->sc_dispatch_thru }}</strong>
												@else
													<span class="text-muted">-</span>
												@endif
											</td>
											<td>
												@if($cert->sc_dispatch_date)
													{{ \Carbon\Carbon::parse($cert->sc_dispatch_date)->format('d-M-Y') }}
												@else
													<span class="text-muted">Not Dispatched</span>
												@endif
											</td>
											<td>
												@if($cert->sc_tracking_number)
													<strong>{{ $cert->sc_tracking_number }}</strong>
												@else
													<span class="text-muted">-</span>
												@endif
											</td>
											<td>
												@if($cert->sc_doc_quantity)
													{{ $cert->sc_doc_quantity }}
												@else
													<span class="text-muted">-</span>
												@endif
											</td>
											<td>
												@if($cert->sc_dispatch_date && $cert->sc_tracking_number)
													<span class="badge-dispatched">Dispatched</span>
												@else
													<span class="badge-pending">Pending</span>
												@endif
											</td>
											<td>
												<a href="{{ route('admin.courier.dispatch', $cert->sc_id) }}" 
												   class="btn-dispatch"
												   title="Dispatch/Update Courier Info">
													<i class="fas fa-truck"></i>
													{{ $cert->sc_dispatch_date ? 'Update' : 'Dispatch' }}
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="alert alert-info text-center">
							<i class="fas fa-info-circle"></i>
							No certificates found.
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
		// Search functionality
		$('#searchInput').on('keyup', function() {
			var value = $(this).val().toLowerCase();
			$('#courierTable tbody tr').filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
			});
		});
	});
</script>
@endpush

