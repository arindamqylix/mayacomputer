@extends('admin.layouts.base')
@section('title', 'Admit Card List')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
	.admit-card-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.admit-card-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.admit-card-header h4 i {
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
		background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
		color: white;
		box-shadow: 0 2px 4px rgba(108, 117, 125, 0.3);
	}
	
	.btn-edit:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(108, 117, 125, 0.4);
		color: white;
		background: linear-gradient(135deg, #5a6268 0%, #6c757d 100%);
	}
	
	.btn-print {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		box-shadow: 0 2px 4px rgba(17, 153, 142, 0.3);
	}
	
	.btn-print:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(17, 153, 142, 0.4);
		color: white;
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
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
	
	/* Generate Button */
	.btn-generate {
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
	
	.btn-generate:hover {
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
	
	/* Date Display */
	.date-display {
		color: #495057;
		font-weight: 500;
		font-family: 'Courier New', monospace;
	}
	
	.time-display {
		background: #f8f9ff;
		color: #2563eb;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 600;
		font-size: 0.875rem;
		display: inline-block;
	}
	
	/* Center Badge */
	.center-badge {
		background: #e9ecef;
		color: #495057;
		padding: 0.25rem 0.75rem;
		border-radius: 0.375rem;
		font-weight: 500;
		font-size: 0.875rem;
		display: inline-block;
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
	<div class="col-12">
		<div class="card modern-card">
			<div class="card-header admit-card-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-ticket-alt"></i>
						Admit Card List
					</h4>
					<a href="{{ route('admin.generate_admit_card') }}" class="btn-generate">
						<i class="fas fa-plus-circle"></i>
						Generate New Admit
					</a>
				</div>
			</div>
			
			<!-- Search Section -->
			<div class="search-section">
				<div class="row align-items-center">
					<div class="col-md-4">
						<div class="search-input-wrapper">
							<i class="fas fa-search"></i>
							<input type="text" id="searchInput" class="form-control" placeholder="Search by registration number, student name, center, venue...">
						</div>
					</div>
					<div class="col-md-4">
						<select class="form-select" id="centerFilter" onchange="window.location.href='{{ route('admin.admit_card_list') }}?center_id='+this.value">
							<option value="">-- Unfilter (Show All) --</option>
							@foreach($centers as $center)
								<option value="{{ $center->cl_id }}" {{ isset($selectedCenterId) && $selectedCenterId == $center->cl_id ? 'selected' : '' }}>
									{{ $center->cl_name }} ({{ $center->cl_code }})
								</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4 text-end">
						<span class="text-muted">
							<i class="fas fa-info-circle me-1"></i>
							Total Admit Cards: <strong>{{ count($admitCards) }}</strong>
						</span>
					</div>
				</div>
			</div>
			
			<div class="card-body p-0">
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
						<i class="fas fa-check-circle me-2"></i>
						{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				@if(session('error'))
					<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
						<i class="fas fa-exclamation-circle me-2"></i>
						{{ session('error') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				@if(count($admitCards) > 0)
					<div class="table-responsive">
						<table id="datatable-buttons" class="table modern-table table-hover mb-0">
							<thead>
								<tr>
									<th><i class="fas fa-hashtag me-2"></i>Reg.No</th>
									<th><i class="fas fa-user me-2"></i>Student Name</th>
									<th><i class="fas fa-building me-2"></i>Center</th>
									<th><i class="fas fa-birthday-cake me-2"></i>DOB</th>
									<th><i class="fas fa-calendar-alt me-2"></i>Exam Date</th>
									<th><i class="fas fa-map-marker-alt me-2"></i>Venue</th>
									<th><i class="fas fa-clock me-2"></i>Time</th>
									<th><i class="fas fa-cog me-2"></i>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($admitCards as $val)
								<tr>
									<td>
										<span class="badge-reg">
											{{ $val->sl_reg_no }}
										</span>
									</td>
									<td>
										<strong>{{ $val->sl_name }}</strong>
									</td>
									<td>
										<span class="center-badge">
											<i class="fas fa-building me-1"></i>
											{{ $val->center_name ?? 'N/A' }}
										</span>
									</td>
									<td>
										<span class="date-display">
											@if($val->sl_dob)
												{{ \Carbon\Carbon::parse($val->sl_dob)->format('d M, Y') }}
											@else
												N/A
											@endif
										</span>
									</td>
									<td>
										<span class="date-display">
											@if($val->exam_date)
												{{ \Carbon\Carbon::parse($val->exam_date)->format('d M, Y') }}
											@else
												N/A
											@endif
										</span>
									</td>
									<td>
										<span class="text-muted">
											<i class="fas fa-map-marker-alt me-1"></i>
											{{ $val->exam_venue ?? 'N/A' }}
										</span>
									</td>
									<td>
										<span class="time-display">
											@if($val->exam_time)
												{{ \Carbon\Carbon::parse($val->exam_time)->format('h:i A') }}
											@else
												N/A
											@endif
										</span>
									</td>
									<td>
										<div class="d-flex gap-2">
											<a href="{{ route('admin.edit_admit_card', $val->ac_id) }}" class="btn-action btn-edit">
												<i class="fas fa-edit"></i>
												Edit
											</a>
											<a href="{{ route('admin.print_admit_card', $val->ac_id) }}" class="btn-action btn-print" target="_blank">
												<i class="fas fa-print"></i>
												Print
											</a>
											<a href="{{ route('admin.delete_admit_card', $val->ac_id) }}" 
											   class="btn-action btn-delete"
											   onclick="return confirm('Are you sure you want to delete this admit card? This action cannot be undone.');">
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
						<i class="fas fa-ticket-alt"></i>
						<h5>No Admit Cards Found</h5>
						<p>Start by generating a new admit card for a student.</p>
						<a href="{{ route('admin.generate_admit_card') }}" class="btn-generate mt-3">
							<i class="fas fa-plus-circle"></i>
							Generate New Admit Card
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
				"order": [[4, "desc"]], // Sort by exam date descending
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
