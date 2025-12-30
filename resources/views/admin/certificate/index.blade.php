@extends('admin.layouts.base')
@section('title', 'Certificate List')
@push('custom-css')
<style type="text/css">
	.certificate-list-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.certificate-list-header h4 {
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
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		font-weight: 600;
		text-transform: uppercase;
		font-size: 0.75rem;
		letter-spacing: 0.5px;
		padding: 1rem;
		border: none;
	}
	
	.modern-table tbody td {
		padding: 1rem;
		vertical-align: middle;
		border-bottom: 1px solid #f0f0f0;
	}
	
	.modern-table tbody tr:hover {
		background-color: #f8f9ff;
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
	
	.btn-delete {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		margin-left: 0.5rem;
	}
	
	.btn-delete:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(235, 51, 73, 0.4);
		color: white;
	}
	
	.badge-status {
		padding: 0.25rem 0.75rem;
		border-radius: 0.25rem;
		font-size: 0.75rem;
		font-weight: 600;
		text-transform: uppercase;
	}
	
	.status-generated {
		background-color: #dbeafe;
		color: #1e40af;
	}
	
	.status-issued {
		background-color: #fef3c7;
		color: #92400e;
	}
	
	.status-verified {
		background-color: #d1fae5;
		color: #065f46;
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="certificate-list-header">
					<div class="d-flex justify-content-between align-items-center">
						<h4>
							<i class="fas fa-certificate"></i>
							All Certificates
						</h4>
						<a href="{{ route('admin.certificate_generate') }}" class="btn-view">
							<i class="fas fa-plus-circle"></i>
							Generate Certificate
						</a>
					</div>
				</div>
				<div class="card-body">
					@if($certificates->count() > 0)
						<div class="table-responsive">
							<table class="table modern-table">
								<thead>
									<tr>
										<th>#</th>
										<th>Certificate No.</th>
										<th>Student Name</th>
										<th>Registration No.</th>
										<th>Course</th>
										<th>Center</th>
										<th>Issue Date</th>
										<th>Dispatch Date</th>
										<th>Tracking No.</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($certificates as $cert)
										<tr>
											<td>{{ $i++ }}</td>
											<td>
												<strong>{{ $cert->sc_certificate_number ?? 'N/A' }}</strong>
											</td>
											<td>{{ $cert->sl_name ?? 'N/A' }}</td>
											<td>{{ $cert->sl_reg_no ?? 'N/A' }}</td>
											<td>{{ $cert->c_short_name ?? $cert->c_full_name ?? 'N/A' }}</td>
											<td>
												{{ $cert->cl_center_name ?? $cert->cl_name ?? 'N/A' }}<br>
												<small class="text-muted">({{ $cert->cl_code ?? 'N/A' }})</small>
											</td>
											<td>
												@if($cert->sc_issue_date)
													{{ \Carbon\Carbon::parse($cert->sc_issue_date)->format('d-M-Y') }}
												@else
													N/A
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
												<span class="badge-status status-{{ strtolower($cert->sc_status ?? 'generated') }}">
													{{ $cert->sc_status ?? 'GENERATED' }}
												</span>
											</td>
											<td>
												<a href="{{ route('admin.view_certificate', $cert->sc_id) }}" 
												   class="btn-view"
												   target="_blank"
												   title="View Certificate">
													<i class="fas fa-eye"></i>
													View
												</a>
												<a href="{{ route('admin.delete_certificate', $cert->sc_id) }}" 
												   class="btn-delete"
												   title="Delete Certificate"
												   onclick="return confirm('Are you sure you want to delete this certificate? This action cannot be undone.');">
													<i class="fas fa-trash"></i>
													Delete
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="text-center py-5">
							<i class="fas fa-certificate fa-3x text-muted mb-3"></i>
							<h5>No Certificates Found</h5>
							<p>Certificates will appear here once centers generate them for students.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

