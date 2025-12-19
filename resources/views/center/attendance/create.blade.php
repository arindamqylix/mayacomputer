@extends('center.layouts.base')
@section('title', 'Manage Batch')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
	.batch-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.batch-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 0.75rem;
	}
	
	.batch-header h4 i {
		font-size: 1.75rem;
	}
	
	.batch-header .header-actions {
		display: flex;
		gap: 0.75rem;
		align-items: center;
	}
	
	/* Modern Card */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
		margin-bottom: 2rem;
	}
	
	/* Form Section */
	.form-section {
		background: #fff;
		border-radius: 12px;
		padding: 2rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		border: 1px solid #e5e7eb;
		height: fit-content;
	}
	
	.form-section h5 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		padding-bottom: 1rem;
		border-bottom: 2px solid #e5e7eb;
	}
	
	.form-section h5 i {
		color: #2563eb;
		font-size: 1.25rem;
	}
	
	.form-group label {
		font-weight: 600;
		color: #374151;
		margin-bottom: 0.5rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 0.9375rem;
	}
	
	.form-group label i {
		color: #2563eb;
		font-size: 0.875rem;
	}
	
	.form-control {
		border: 2px solid #e5e7eb;
		border-radius: 8px;
		padding: 0.75rem 1rem;
		font-size: 0.9375rem;
		transition: all 0.3s ease;
		color: #1e3a8a;
	}
	
	.form-control:focus {
		border-color: #2563eb;
		outline: none;
		box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
	}
	
	.btn-save-batch {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 1rem;
		width: 100%;
		transition: all 0.3s ease;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 0.5rem;
	}
	
	.btn-save-batch:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.4);
	}
	
	.btn-save-batch:active {
		transform: translateY(0);
	}
	
	/* Table Section */
	.table-section {
		background: #fff;
		border-radius: 12px;
		padding: 2rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		border: 1px solid #e5e7eb;
	}
	
	/* Enhanced Table */
	.modern-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
	}
	
	.modern-table thead {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
	}
	
	.modern-table thead th {
		color: white;
		font-weight: 600;
		padding: 1rem;
		text-align: left;
		border: none;
		font-size: 0.875rem;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	
	.modern-table thead th:first-child {
		border-top-left-radius: 8px;
	}
	
	.modern-table thead th:last-child {
		border-top-right-radius: 8px;
	}
	
	.modern-table tbody tr {
		transition: all 0.2s ease;
		border-bottom: 1px solid #e5e7eb;
	}
	
	.modern-table tbody tr:hover {
		background: linear-gradient(90deg, #f8f9ff 0%, #ffffff 100%);
		transform: scale(1.01);
		box-shadow: 0 2px 8px rgba(0,0,0,0.05);
	}
	
	.modern-table tbody td {
		padding: 1rem;
		color: #374151;
		font-size: 0.875rem;
		vertical-align: middle;
	}
	
	/* Batch Name */
	.batch-name {
		color: #1e3a8a;
		font-weight: 600;
		font-size: 0.9375rem;
	}
	
	/* Time Display */
	.time-display {
		color: #6b7280;
		font-family: 'Courier New', monospace;
		font-size: 0.875rem;
		font-weight: 500;
	}
	
	/* Status Badge */
	.status-badge {
		display: inline-block;
		padding: 0.375rem 0.75rem;
		border-radius: 6px;
		font-weight: 600;
		font-size: 0.8125rem;
		letter-spacing: 0.5px;
	}
	
	.status-badge.active {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
	}
	
	.status-badge.pending {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
	}
	
	.status-badge.block {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
	}
	
	/* Delete Button */
	.btn-delete {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
		border: none;
		padding: 0.5rem 1rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 0.875rem;
		cursor: pointer;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-delete:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(245, 87, 108, 0.4);
	}
	
	.btn-delete:active {
		transform: translateY(0);
	}
	
	/* Empty State */
	.empty-state {
		text-align: center;
		padding: 4rem 2rem;
		color: #6c757d;
	}
	
	.empty-state i {
		font-size: 4rem;
		margin-bottom: 1rem;
		opacity: 0.5;
		color: #2563eb;
	}
	
	.empty-state h5 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 0.5rem;
	}
	
	.empty-state p {
		color: #6b7280;
		font-size: 0.9375rem;
	}
	
	/* Success/Error Messages */
	.alert-custom {
		border-radius: 8px;
		padding: 1rem 1.5rem;
		margin-bottom: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		font-weight: 500;
	}
	
	.alert-success-custom {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.3);
	}
	
	.alert-error-custom {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
		border: none;
		box-shadow: 0 4px 12px rgba(245, 87, 108, 0.3);
	}
</style>
@endpush
@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
	<div class="alert-success-custom">
		<i class="fas fa-check-circle"></i>
		<span>{{ session('success') }}</span>
	</div>
@endif

@if(session('error'))
	<div class="alert-error-custom">
		<i class="fas fa-exclamation-circle"></i>
		<span>{{ session('error') }}</span>
	</div>
@endif

<!-- Main Card -->
<div class="card modern-card">
	<div class="batch-header">
		<h4>
			<span style="display: flex; align-items: center; gap: 0.75rem;">
				<i class="fas fa-calendar-alt"></i>
				Manage Attendance Batch
			</span>
			<div class="header-actions">
				<a href="{{ route('student_list') }}" class="btn btn-light btn-sm" style="color: #1e3a8a; font-weight: 600;">
					<i class="fas fa-list"></i> View All Students
				</a>
			</div>
		</h4>
	</div>
	<div class="card-body" style="padding: 2rem;">
		<div class="row">
			<!-- Form Section -->
			<div class="col-md-4">
				<div class="form-section">
					<h5>
						<i class="fas fa-plus-circle"></i>
						Create New Batch
					</h5>
					<form method="POST" action="{{ route('attndance_batch') }}" id="insert_frm">
						@csrf
						<div class="form-group mb-3">
							<label for="batch_name">
								<i class="fas fa-tag"></i>
								Batch Name
							</label>
							<input 
								class="form-control" 
								placeholder="Enter batch name" 
								name="batch_name" 
								id="batch_name"
								required
							>
						</div>
						
						<div class="form-group mb-3">
							<label for="start_time">
								<i class="fas fa-clock"></i>
								Start Time
							</label>
							<input 
								class="form-control" 
								name="start_time" 
								id="start_time"
								type="time" 
								required
							>
						</div>
						
						<div class="form-group mb-3">
							<label for="end_time">
								<i class="fas fa-clock"></i>
								End Time
							</label>
							<input 
								class="form-control" 
								name="end_time" 
								id="end_time"
								type="time" 
								required
							>
						</div>
						
						<div class="form-group mb-3">
							<label for="status">
								<i class="fas fa-toggle-on"></i>
								Status
							</label>
							<select class="form-control" name="status" id="status" required>
								<option value="ACTIVE">ACTIVE</option>
								<option value="PENDING">PENDING</option>
								<option value="BLOCK">BLOCK</option>
							</select>
						</div>
						
						<button type="submit" class="btn-save-batch" id="insert_btn">
							<i class="fas fa-save"></i>
							Save Batch
						</button>
					</form>
				</div>
			</div>
			
			<!-- Table Section -->
			<div class="col-lg-8">
				<div class="table-section">
					<h5 style="color: #1e3a8a; font-weight: 600; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; padding-bottom: 1rem; border-bottom: 2px solid #e5e7eb;">
						<i class="fas fa-list"></i>
						All Batches
					</h5>
					
					@if(count($attndance_batch) > 0)
						<div class="table-responsive">
							<table id="data_tbl" class="table modern-table">
								<thead>
									<tr>
										<th>Batch Name</th>
										<th>Start Time</th>
										<th>End Time</th>
										<th>Status</th>
										<th>Operation</th>
									</tr>
								</thead>
								<tbody>
									@foreach($attndance_batch as $data)
										<tr>
											<td>
												<span class="batch-name">{{ $data->ab_name }}</span>
											</td>
											<td>
												<span class="time-display">{{ date('h:i A', strtotime($data->ab_start_time)) }}</span>
											</td>
											<td>
												<span class="time-display">{{ date('h:i A', strtotime($data->ab_end_time)) }}</span>
											</td>
											<td>
												@php
													$statusClass = strtolower($data->ab_status);
													if($statusClass == 'active') $statusClass = 'active';
													elseif($statusClass == 'pending') $statusClass = 'pending';
													else $statusClass = 'block';
												@endphp
												<span class="status-badge {{ $statusClass }}">{{ $data->ab_status }}</span>
											</td>
											<td>
												<a 
													onclick="return confirm('Are you sure you want to delete this batch?');" 
													href="{{ route('attndance_batch_delete', $data->ab_id) }}" 
													class="btn-delete"
												>
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
						<div class="empty-state">
							<i class="fas fa-calendar-times"></i>
							<h5>No Batches Found</h5>
							<p>Create your first attendance batch using the form on the left.</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Check if DataTable is already initialized and destroy it first
		if ($.fn.DataTable) {
			// Destroy existing DataTable instance if it exists
			if ($.fn.DataTable.isDataTable('#data_tbl')) {
				$('#data_tbl').DataTable().destroy();
			}
			
			// Initialize DataTable only if table exists
			if ($('#data_tbl').length && $('#data_tbl tbody tr').length > 0) {
				var table = $('#data_tbl').DataTable({
					"order": [[0, "asc"]], // Sort by batch name
					"pageLength": 10,
					"language": {
						"search": "",
						"searchPlaceholder": "Search batches..."
					},
					"dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
				});
			}
		}
	});
</script>
@endpush
