@extends('center.layouts.base')
@section('title', 'Result Updated Student List')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	.student-list-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.student-list-header h4 {
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
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
	}
	
	.badge-reg {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
		font-family: 'Courier New', monospace;
	}
	
	.status-badge {
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
		text-transform: uppercase;
		display: inline-block;
	}
	
	.status-badge.result-updated {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
	}
	
	.student-image {
		width: 50px;
		height: 50px;
		object-fit: cover;
		border-radius: 50%;
		border: 2px solid #2563eb;
		box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
	}
	
	.btn-add {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		transition: all 0.3s ease;
	}
	
	.btn-add:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		color: white;
		text-decoration: none;
	}
	
	.date-display {
		color: #495057;
		font-weight: 500;
		font-family: 'Courier New', monospace;
		font-size: 0.875rem;
	}
	
	.student-name-link {
		color: #2563eb;
		font-weight: 600;
		text-decoration: none;
	}
	
	.student-name-link:hover {
		color: #1e40af;
		text-decoration: underline;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card modern-card">
			<div class="card-header student-list-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-file-alt"></i>
						Result Updated Student List
					</h4>
					<a href="{{ route('add_student') }}" class="btn-add">
						<i class="fas fa-plus-circle"></i>
						Add New Student
					</a>
				</div>
			</div>
			<div class="card-body p-0">
				@if(count($student) > 0)
					<div class="table-responsive">
						<table id="datatable-buttons" class="table modern-table table-hover mb-0">
							<thead>
								<tr>
									<th><i class="fas fa-code me-2"></i>Center Code</th>
									<th><i class="fas fa-id-card me-2"></i>Reg.No</th>
									<th><i class="fas fa-user me-2"></i>Student Name</th>
									<th><i class="fas fa-birthday-cake me-2"></i>Date of Birth</th>
									<th><i class="fas fa-graduation-cap me-2"></i>Course</th>
									<th><i class="fas fa-info-circle me-2"></i>Status</th>
									<th><i class="fas fa-image me-2"></i>Image</th>
								</tr>
							</thead>
							<tbody>
								@foreach($student as $data)
									<tr>
										<td><span class="badge-reg">{{ $data->cl_code ?? 'N/A' }}</span></td>
										<td><span class="badge-reg">{{ $data->sl_reg_no ?? 'N/A' }}</span></td>
										<td>
											<a href="{{ route('student_application', $data->sl_id) }}" target="_blank" class="student-name-link">
												{{ $data->sl_name ?? 'N/A' }}
											</a>
										</td>
										<td>
											<span class="date-display">
												@if($data->sl_dob)
													{{ \Carbon\Carbon::parse($data->sl_dob)->format('d M, Y') }}
												@else
													N/A
												@endif
											</span>
										</td>
										<td><span class="text-muted">{{ $data->c_short_name ?? 'N/A' }}</span></td>
										<td>
											<span class="status-badge result-updated">{{ $data->sl_status ?? 'RESULT UPDATED' }}</span>
										</td>
										<td>
											@if(!empty($data->sl_photo))
												<img class="student-image" src="{{ asset('center/student_doc/').'/'.$data->sl_photo }}" alt="Student Photo" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2750%27 height=%2750%27%3E%3Crect fill=%27%23ddd%27 width=%2750%27 height=%2750%27/%3E%3Ctext fill=%27%23999%27 font-family=%27sans-serif%27 font-size=%2712%27 x=%2750%25%27 y=%2750%25%27 text-anchor=%27middle%27 dy=%27.3em%27%3ENo Photo%3C/text%3E%3C/svg%3E'">
											@else
												<img class="student-image" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='50' height='50'%3E%3Crect fill='%23ddd' width='50' height='50'/%3E%3Ctext fill='%23999' font-family='sans-serif' font-size='12' x='50%25' y='50%25' text-anchor='middle' dy='.3em'%3ENo Photo%3C/text%3E%3C/svg%3E" alt="No Photo">
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<div class="text-center p-5">
						<i class="fas fa-file-alt" style="font-size: 4rem; color: #6c757d; opacity: 0.5;"></i>
						<h5 class="mt-3">No Result Updated Students Found</h5>
						<p class="text-muted">Students with updated results will appear here.</p>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
@endpush
