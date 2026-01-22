@extends('center.layouts.base')
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
	
	/* Action Buttons */
	.btn-view-id {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		transition: all 0.3s ease;
		border: none;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
	}
	
	.btn-view-id:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(37, 99, 235, 0.4);
		color: white;
		text-decoration: none;
		background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
	}
	
	/* Badge Styles */
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
	
	.status-badge.result-out {
		background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
		color: white;
	}
	
	.status-badge.verified {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
	}
	
	.status-badge.pending {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
		color: white;
	}
	
	.status-badge.dispatched {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
	}
	
	/* Date Display */
	.date-display {
		color: #495057;
		font-weight: 500;
		font-family: 'Courier New', monospace;
		font-size: 0.875rem;
	}
	
	/* Student Name Link */
	.student-name-link {
		color: #2563eb;
		font-weight: 600;
		text-decoration: none;
		transition: all 0.3s ease;
	}
	
	.student-name-link:hover {
		color: #1e40af;
		text-decoration: underline;
	}
	
	/* Student Image */
	.student-image {
		width: 50px;
		height: 50px;
		object-fit: cover;
		border-radius: 50%;
		border: 2px solid #2563eb;
		box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
		transition: all 0.3s ease;
	}
	
	.student-image:hover {
		transform: scale(1.1);
		box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
	}
	
	/* Empty State */
	.empty-state {
		text-align: center;
		padding: 3rem;
		color: #6c757d;
	}
	
	.empty-state i {
		font-size: 4rem;
		margin-bottom: 1rem;
		opacity: 0.5;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card modern-card">
					<div class="card-header student-list-header">
				<h4>
					<i class="fas fa-id-card"></i>
					Student Registration Card List
				</h4>
			</div>
			
			<!-- Search Section -->
			<div class="search-section">
				<div class="row">
					<div class="col-md-6">
						<div class="search-input-wrapper">
							<i class="fas fa-search"></i>
							<input type="text" id="searchInput" class="form-control" placeholder="Search by registration number, student name, course...">
						</div>
					</div>
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
									<th><i class="fas fa-cog me-2"></i>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($student as $data)
									<tr>
										<td>
											<span class="badge-reg">{{ $data->cl_code ?? 'N/A' }}</span>
										</td>
										<td>
											<span class="badge-reg">{{ $data->sl_reg_no ?? 'N/A' }}</span>
										</td>
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
										<td>
											<span class="text-muted">{{ $data->c_short_name ?? 'N/A' }}</span>
										</td>
										<td>
											@php
												$status = strtoupper($data->sl_status ?? 'PENDING');
												$statusClass = strtolower(str_replace(' ', '-', $status));
											@endphp
											<span class="status-badge {{ $statusClass }}">
												{{ $status }}
											</span>
										</td>
										<td>
											@if(!empty($data->sl_photo))
												<img class="student-image" 
													 src="{{ asset($data->sl_photo) }}" 
													 alt="Student Photo"
													 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2750%27 height=%2750%27%3E%3Crect fill=%27%23ddd%27 width=%2750%27 height=%2750%27/%3E%3Ctext fill=%27%23999%27 font-family=%27sans-serif%27 font-size=%2712%27 x=%2750%25%27 y=%2750%25%27 text-anchor=%27middle%27 dy=%27.3em%27%3ENo Photo%3C/text%3E%3C/svg%3E'">
											@else
												<img class="student-image" 
													 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='50' height='50'%3E%3Crect fill='%23ddd' width='50' height='50'/%3E%3Ctext fill='%23999' font-family='sans-serif' font-size='12' x='50%25' y='50%25' text-anchor='middle' dy='.3em'%3ENo Photo%3C/text%3E%3C/svg%3E" 
													 alt="No Photo">
											@endif
										</td>
										<td>
											<a href="{{ route('center.student_registration_card', $data->sl_id) }}" 
											   class="btn-view-id" 
											   target="_blank"
											   title="View Registration Card">
												<i class="fas fa-file-alt"></i>
												View Reg. Card
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<div class="empty-state">
						<i class="fas fa-file-alt"></i>
						<h5>No Students Found</h5>
						<p>Student registration cards will appear here once students are registered.</p>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Check if DataTable is already initialized and destroy it first
		if ($.fn.DataTable && $.fn.DataTable.isDataTable('#datatable-buttons')) {
			$('#datatable-buttons').DataTable().destroy();
		}
		
		// Initialize DataTable if available
		if ($.fn.DataTable) {
			var table = $('#datatable-buttons').DataTable({
				"order": [[1, "desc"]], // Sort by registration number descending
				"pageLength": 25,
				"language": {
					"search": "",
					"searchPlaceholder": "Search..."
				},
				"dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
			});
			
			// Custom search input
			$('#searchInput').on('keyup', function() {
				table.search(this.value).draw();
			});
		} else {
			// Fallback search if DataTable is not available
			$('#searchInput').on('keyup', function() {
				var value = $(this).val().toLowerCase();
				$('table tbody tr').filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
				});
			});
		}
	});
</script>
@endpush
