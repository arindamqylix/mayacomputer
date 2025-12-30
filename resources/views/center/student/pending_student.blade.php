@extends('center.layouts.base')
@section('title', 'Pending Student List')
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
	.btn-action {
		padding: 0.5rem 1rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		transition: all 0.3s ease;
		border: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		text-decoration: none;
	}
	
	.btn-edit {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);
	}
	
	.btn-edit:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(37, 99, 235, 0.4);
		color: white;
		background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
	}
	
	.btn-delete {
		background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
		color: white;
		box-shadow: 0 2px 4px rgba(235, 51, 73, 0.3);
	}
	
	.btn-delete:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(235, 51, 73, 0.4);
		color: white;
		background: linear-gradient(135deg, #f45c43 0%, #eb3349 100%);
	}
	
	.btn-add {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-add:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
		color: white;
		text-decoration: none;
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
	
	.status-badge.pending {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-clock"></i>
						Pending Student List
					</h4>
					<a href="{{ route('add_student') }}" class="btn-add">
						<i class="fas fa-plus-circle"></i>
						Add New Student
					</a>
				</div>
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
									<th><i class="fas fa-hashtag me-2"></i>Center Code</th>
									<th><i class="fas fa-id-card me-2"></i>Reg.No</th>
									<th><i class="fas fa-user me-2"></i>Student Name</th>
									<th><i class="fas fa-birthday-cake me-2"></i>Date of Birth</th>
									<th><i class="fas fa-graduation-cap me-2"></i>Course</th>
									<th><i class="fas fa-info-circle me-2"></i>Status</th>
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
											<span class="status-badge pending">{{ $data->sl_status ?? 'PENDING' }}</span>
										</td>
										<td>
											<div class="d-flex gap-2">
												<a href="{{ route('edit.student', $data->sl_id) }}" class="btn-action btn-edit">
													<i class="fas fa-edit"></i>
													Edit
												</a>
												<a href="{{ route('delete.student', $data->sl_id) }}" 
												   class="btn-action btn-delete"
												   onclick="return confirm('Are you sure you want to delete this student?')">
													<i class="fas fa-trash"></i>
													Delete
												</a>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<div class="empty-state">
						<i class="fas fa-user-clock"></i>
						<h5>No Pending Students Found</h5>
						<p>All students have been processed or start by adding a new student.</p>
						<a href="{{ route('add_student') }}" class="btn-add mt-3">
							<i class="fas fa-plus-circle"></i>
							Add New Student
						</a>
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
		// Initialize DataTable if available
		if ($.fn.DataTable) {
			// Destroy existing DataTable instance if it exists
			if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
				$('#datatable-buttons').DataTable().destroy();
			}
			
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
