@extends('admin.layouts.base')
@section('title', 'Course Syllabus')
@push('custom-css')
<style type="text/css">
	.syllabus-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.syllabus-header h4 {
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
	
	.btn-add {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
		border: none;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-add:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		color: white;
		text-decoration: none;
	}
	
	.badge-video {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		color: white;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
	}
	
	.badge-pdf {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
	}
	
	.badge-active {
		background-color: #d1fae5;
		color: #065f46;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
	}
	
	.badge-inactive {
		background-color: #fee2e2;
		color: #991b1b;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
	}
	
	.btn-action {
		padding: 0.375rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		transition: all 0.3s ease;
		border: none;
		display: inline-flex;
		align-items: center;
		gap: 0.375rem;
		text-decoration: none;
		margin: 0 0.125rem;
	}
	
	.btn-edit {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
	}
	
	.btn-edit:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(37, 99, 235, 0.4);
		color: white;
	}
	
	.btn-delete {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		color: white;
	}
	
	.btn-delete:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(235, 51, 73, 0.4);
		color: white;
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="syllabus-header">
					<div class="d-flex justify-content-between align-items-center">
						<h4>
							<i class="fas fa-book"></i>
							Course Syllabus Management
						</h4>
						<a href="{{ route('admin.syllabus.create') }}" class="btn-add">
							<i class="fas fa-plus-circle"></i>
							Add Syllabus
						</a>
					</div>
				</div>
				
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
						<i class="fas fa-check-circle"></i> {{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				@endif
				
				@if(session('error'))
					<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
						<i class="fas fa-exclamation-circle"></i> {{ session('error') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
				@endif
				
				<div class="card-body">
					@if($syllabus->count() > 0)
						<div class="table-responsive">
							<table id="datatable-buttons" class="table modern-table table-hover mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Course</th>
										<th>Type</th>
										<th>Title</th>
										<th>Description</th>
										<th>Order</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($syllabus as $item)
										<tr>
											<td>{{ $i++ }}</td>
											<td>
												<strong>{{ $item->c_full_name ?? 'N/A' }}</strong><br>
												<small class="text-muted">{{ $item->c_short_name ?? '' }}</small>
											</td>
											<td>
												@if($item->cs_type == 'video')
													<span class="badge-video">
														<i class="fas fa-video"></i> Video
													</span>
												@else
													<span class="badge-pdf">
														<i class="fas fa-file-pdf"></i> PDF
													</span>
												@endif
											</td>
											<td><strong>{{ $item->cs_title }}</strong></td>
											<td>{{ $item->cs_description ? substr($item->cs_description, 0, 50) . '...' : 'N/A' }}</td>
											<td>{{ $item->cs_order }}</td>
											<td>
												@if($item->cs_status == 'active')
													<span class="badge-active">Active</span>
												@else
													<span class="badge-inactive">Inactive</span>
												@endif
											</td>
											<td>
												<a href="{{ route('admin.syllabus.edit', $item->cs_id) }}" class="btn-action btn-edit" title="Edit">
													<i class="fas fa-edit"></i> Edit
												</a>
												<a href="{{ route('admin.syllabus.delete', $item->cs_id) }}" 
												   class="btn-action btn-delete" 
												   title="Delete"
												   onclick="return confirm('Are you sure you want to delete this syllabus?')">
													<i class="fas fa-trash"></i> Delete
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="text-center py-5">
							<i class="fas fa-book fa-3x text-muted mb-3"></i>
							<h5>No Syllabus Found</h5>
							<p>Start by adding syllabus for courses.</p>
							<a href="{{ route('admin.syllabus.create') }}" class="btn-add mt-3">
								<i class="fas fa-plus-circle"></i>
								Add Syllabus
							</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

