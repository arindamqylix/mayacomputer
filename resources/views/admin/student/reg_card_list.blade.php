@extends('admin.layouts.base')
@section('title', 'Student Registration Card List')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
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
	
	.student-list-header h4 i {
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
	
	/* Student Image */
	.student-image {
		width: 50px;
		height: 50px;
		object-fit: cover;
		border-radius: 50%;
		border: 3px solid #e9ecef;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		transition: all 0.3s ease;
	}
	
	.student-image:hover {
		transform: scale(1.1);
		border-color: #2563eb;
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
	
	.status-pending {
		background-color: #fff3cd;
		color: #856404;
	}
	
	.status-verified {
		background-color: #d1ecf1;
		color: #0c5460;
	}
	
	.status-result-updated {
		background-color: #d4edda;
		color: #155724;
	}
	
	.status-result-out {
		background-color: #cce5ff;
		color: #004085;
	}
	
	.status-dispatched {
		background-color: #e2e3e5;
		color: #383d41;
	}
	
	.status-block {
		background-color: #f8d7da;
		color: #721c24;
	}
	
	/* Student Name Link */
	.student-name-link {
		color: #2563eb;
		text-decoration: none;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	
	.student-name-link:hover {
		color: #1e40af;
		text-decoration: underline;
	}
	
	/* Action Grid */
	.action-grid {
		display: flex;
		gap: 0.5rem;
		justify-content: flex-start;
		align-items: center;
	}
    
    /* View Card Button */
    .btn-view-card {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 6px rgba(17, 153, 142, 0.2);
    }
    
    .btn-view-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(17, 153, 142, 0.3);
        background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
        color: white;
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
	
	/* Registration Number */
	.reg-number {
		font-family: 'Courier New', monospace;
		font-weight: 600;
		color: #2563eb;
	}
	
	/* Date Display */
	.date-display {
		color: #6c757d;
		font-size: 0.875rem;
	}
    
    /* Course Badge */
	.course-badge {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
		padding: 0.375rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.75rem;
		display: inline-block;
	}
	
	/* Responsive */
	@media (max-width: 768px) {
		.student-list-header h4 {
			font-size: 1.25rem;
		}
		
		.modern-table thead th,
		.modern-table tbody td {
			padding: 0.75rem 0.5rem;
			font-size: 0.875rem;
		}
		
		.student-image {
			width: 40px;
			height: 40px;
		}
        
        .btn-view-card span {
            display: none;
        }
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card modern-card">
			<!-- Modern Header -->
			<div class="card-header student-list-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-address-card"></i>
						Student Registration Card List
					</h4>
				</div>
			</div>
			
			<!-- Search Section -->
			<div class="search-section">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="search-input-wrapper">
							<i class="fas fa-search"></i>
							<input type="text" id="searchInput" class="form-control" placeholder="Search by name, registration number, center code, or course...">
						</div>
					</div>
					<div class="col-md-6 text-end">
						<span class="text-muted">
							<i class="fas fa-info-circle me-1"></i>
							Total Students: <strong>{{ count($student) }}</strong>
						</span>
					</div>
				</div>
			</div>
			
			<!-- Table Section -->
			<div class="card-body p-0">
				<div class="table-responsive">
					<table id="student-list-table" class="table modern-table table-hover w-100">
						<thead>
							<tr>
								<th><i class="fas fa-building me-2"></i>Center Code</th>
								<th><i class="fas fa-id-card me-2"></i>Reg.No</th>
								<th><i class="fas fa-user me-2"></i>Student Name</th>
								<th><i class="fas fa-image me-2"></i>Image</th>
								<th><i class="fas fa-birthday-cake me-2"></i>Date of Birth</th>
								<th><i class="fas fa-book me-2"></i>Course</th>
								<th><i class="fas fa-info-circle me-2"></i>Status</th>
								<th><i class="fas fa-tools me-2"></i>Operation</th>
							</tr>
						</thead>
						<tbody>
							@php $i=1; @endphp
							@foreach($student as $data)
								<tr>
									<td>
										<span class="center-code">{{ $data->cl_code }}</span>
									</td>
									<td>
										<span class="reg-number">{{ $data->sl_reg_no }}</span>
									</td>
									<td>
										<span class="student-name-link">
											{{ $data->sl_name }}
										</span>
									</td>
									<td>
										@if(!empty($data->sl_photo))
											<img class="student-image" 
											     src="{{ asset($data->sl_photo) }}" 
											     alt="{{ $data->sl_name }}" 
											     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2750%27 height=%2750%27%3E%3Crect fill=%27%23ddd%27 width=%2750%27 height=%2750%27/%3E%3Ctext fill=%27%23999%27 font-family=%27sans-serif%27 font-size=%2710%27 x=%2750%25%27 y=%2750%25%27 text-anchor=%27middle%27 dy=%27.3em%27%3ENo Photo%3C/text%3E%3C/svg%3E'">
										@else
											<img class="student-image" 
											     src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='50' height='50'%3E%3Crect fill='%23ddd' width='50' height='50'/%3E%3Ctext fill='%23999' font-family='sans-serif' font-size='10' x='50%25' y='50%25' text-anchor='middle' dy='.3em'%3ENo Photo%3C/text%3E%3C/svg%3E" 
											     alt="No Photo">
										@endif
									</td>
									<td>
										<span class="date-display">
											@if($data->sl_dob && $data->sl_dob != '0000-00-00')
												@php
													try {
														$date = \Carbon\Carbon::parse($data->sl_dob)->format('d M, Y');
													} catch (\Exception $e) {
														$date = $data->sl_dob;
													}
												@endphp
												{{ $date }}
											@else
												N/A
											@endif
										</span>
									</td>
									<td>
										<span class="course-badge">{{ $data->c_short_name }}</span>
									</td>
									<td>
										@php
											$status = strtolower(str_replace(' ', '-', $data->sl_status));
										@endphp
										<span class="status-badge status-{{ $status }}">
											{{ $data->sl_status }}
										</span>
									</td>
									<td>
                                        <a href="{{ route('student_registration_card', $data->sl_id) }}" target="_blank" class="btn-view-card">
                                            <i class="fas fa-eye"></i>
                                            <span>View Reg Card</span>
                                        </a>
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

@push('custom-script')
<script type="text/javascript">
	$(document).ready(function() {
		// Initialize DataTable
		if ($.fn.DataTable.isDataTable('#student-list-table')) {
			$('#student-list-table').DataTable().destroy();
		}
		
		var table = $('#student-list-table').DataTable({
			lengthChange: false,
			buttons: ['copy', 'excel', 'pdf'],
			dom: 'Bfrtip',
			pageLength: 10,
			responsive: true
		});
		
		// Append buttons to wrapper if it exists (for layout consistency)
		table.buttons().container().appendTo('#student-list-table_wrapper .col-md-6:eq(0)');
		
		// Custom search input
		$('#searchInput').on('keyup', function() {
			table.search(this.value).draw();
		});
	});
</script>
@endpush
