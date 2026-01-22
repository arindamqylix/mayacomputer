@extends('center.layouts.base')
@section('title', 'Mark Attendance')

@push('custom-css')
<style>
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
	.attendance-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.attendance-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.attendance-header h4 i {
		font-size: 1.75rem;
	}
	
	/* Modern Card */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
		margin-bottom: 2rem;
	}
	
	/* Filter Section */
	.filter-section {
		background: #fff;
		border-radius: 12px;
		padding: 1.5rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		margin-bottom: 2rem;
		border: 1px solid #e5e7eb;
	}
	
	.filter-section label {
		font-weight: 600;
		color: #1e3a8a;
		margin-bottom: 0.75rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 0.9375rem;
	}
	
	.filter-section label i {
		color: #2563eb;
		font-size: 1rem;
	}
	
	.filter-section .form-control,
	.filter-section select {
		border: 2px solid #e5e7eb;
		border-radius: 8px;
		padding: 0.75rem 1rem;
		font-size: 0.9375rem;
		transition: all 0.3s ease;
		color: #1e3a8a;
		min-height: 45px;
	}
	
	.filter-section .form-control:focus,
	.filter-section select:focus {
		border-color: #2563eb;
		outline: none;
		box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
	}
	
	.btn-filter {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		border: none;
		padding: 0.625rem 1.5rem;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
	}
	
	.btn-filter:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
	}
	
	.btn-reset {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
		border: none;
		padding: 0.625rem 1.5rem;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
		text-decoration: none;
		display: inline-block;
	}
	
	.btn-reset:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(245, 87, 108, 0.4);
		color: white;
		text-decoration: none;
	}
	
	/* Date Info Card */
	.date-info-card {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border-radius: 12px;
		padding: 1.5rem;
		margin-bottom: 2rem;
		box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
	}
	
	.date-info-card h5 {
		margin: 0;
		font-weight: 600;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		font-size: 1.25rem;
	}
	
	.date-info-card h5 i {
		font-size: 1.5rem;
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
	
	/* Registration Number Badge */
	.reg-badge {
		display: inline-block;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		padding: 0.375rem 0.75rem;
		border-radius: 6px;
		font-weight: 600;
		font-size: 0.8125rem;
		letter-spacing: 0.5px;
	}
	
	/* Student Name */
	.student-name {
		color: #1e3a8a;
		font-weight: 600;
		font-size: 0.9375rem;
	}
	
	/* Custom Checkbox */
	.checkbox-wrapper {
		position: relative;
		display: inline-block;
	}
	
	.checkbox-wrapper input[type="checkbox"] {
		width: 24px;
		height: 24px;
		cursor: pointer;
		accent-color: #2563eb;
	}
	
	.checkbox-wrapper input[type="checkbox"]:checked {
		accent-color: #11998e;
	}
	
	/* Save Button */
	.btn-save-attendance {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 1rem;
		cursor: pointer;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		margin-top: 1.5rem;
	}
	
	.btn-save-attendance:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.4);
	}
	
	.btn-save-attendance:active {
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
	
	/* Success Alert */
	.alert-success-custom {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		border-radius: 8px;
		padding: 1rem 1.5rem;
		margin-bottom: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		font-weight: 500;
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.3);
	}
	
	.alert-success-custom i {
		font-size: 1.25rem;
	}
</style>
@endpush

@section('content')

<!-- Success Message -->
@if(session('success'))
	<div class="alert-success-custom">
		<i class="fas fa-check-circle"></i>
		<span>{{ session('success') }}</span>
	</div>
@endif

<!-- Main Card -->
<div class="card modern-card">
	<div class="attendance-header">
		<h4>
			<i class="fas fa-check-square"></i>
			Mark Attendance
		</h4>
	</div>
	<div class="card-body" style="padding: 2rem;">
		
		<!-- Filter Form -->
		<div class="filter-section">
			<form action="" method="GET" class="row">
				<div class="col-lg-4 mb-3">
					<label for="batch_id">
						<i class="fas fa-calendar-alt"></i>
						Select Batch
					</label>
					<select name="batch_id" id="batch_id" class="form-control">
						<option value="">-- Select Batch --</option>
						@foreach($batch as $b)
							<option value="{{ $b->ab_id }}" {{ request('batch_id') == $b->ab_id ? 'selected' : '' }}>
								{{ $b->ab_name }}
							</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-4 mb-3">
					<label for="att_date">
						<i class="fas fa-calendar"></i>
						Select Date
					</label>
					<input 
						type="date" 
						name="att_date" 
						id="att_date"
						class="form-control"
						value="{{ request('att_date') }}"
					>
				</div>

				<div class="col-lg-4 mb-3">
					<label>&nbsp;</label><br>
					<button type="submit" class="btn-filter">
						<i class="fas fa-filter"></i> Filter
					</button>
					<a href="{{ route('make_attendance') }}" class="btn-reset">
						<i class="fas fa-redo"></i> Reset
					</a>
				</div>
			</form>
		</div>

		<!-- Show Attendance Table -->
		@if(request('batch_id') && request('att_date'))
			@php
				$date = \Carbon\Carbon::parse(request('att_date'));
			@endphp

			<div class="date-info-card">
				<h5>
					<i class="fas fa-calendar-check"></i>
					Attendance for {{ $date->format('d-M-Y (l)') }}
				</h5>
			</div>

			@if($students->count() > 0)
				<form action="{{ route('save_attendance') }}" method="POST">
					@csrf

					<input type="hidden" name="batch_id" value="{{ request('batch_id') }}">
					<input type="hidden" name="att_date" value="{{ request('att_date') }}">

					<div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded border">
						<h6 class="mb-0 fw-bold text-dark"><i class="fas fa-check-double me-2"></i>Quick Action (Select All):</h6>
						<div class="d-flex gap-4">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="select_all" id="all_present" value="PRESENT" onchange="toggleAll('PRESENT')">
								<label class="form-check-label fw-bold text-success" for="all_present">Present (P)</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="select_all" id="all_absent" value="ABSENT" onchange="toggleAll('ABSENT')">
								<label class="form-check-label fw-bold text-danger" for="all_absent">Absent (A)</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="select_all" id="all_holiday" value="HOLIDAY" onchange="toggleAll('HOLIDAY')">
								<label class="form-check-label fw-bold text-warning" for="all_holiday">Holiday (H)</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="select_all" id="all_sunday" value="SUNDAY" onchange="toggleAll('SUNDAY')">
								<label class="form-check-label fw-bold text-info" for="all_sunday">Sunday (S)</label>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table id="datatable-buttons" class="table modern-table">
							<thead>
								<tr>
									<th style="width: 10%;">Roll No</th>
									<th style="width: 30%;">Student Name</th>
									<th style="width: 60%;">Mark Status</th>
								</tr>
							</thead>

							<tbody>
								@foreach($students as $stu)
									<tr>
										<td>
											<span class="reg-badge">{{ $stu->sl_reg_no }}</span>
										</td>
										<td>
											<span class="student-name">{{ $stu->sl_name }}</span>
										</td>
										<td>
											<input type="hidden" name="student_id[]" value="{{ $stu->sl_id }}">
											<div class="d-flex gap-3 align-items-center flex-wrap">
												<!-- Present -->
												<div class="form-check">
													<input 
														class="form-check-input input-present" 
														type="radio" 
														name="attd[{{ $stu->sl_id }}]" 
														id="present_{{ $stu->sl_id }}" 
														value="PRESENT"
														style="cursor: pointer; accent-color: #11998e;"
														{{ (isset($marked[$stu->sl_id]) && $marked[$stu->sl_id] === 'PRESENT') ? 'checked' : '' }}
													>
													<label class="form-check-label text-success fw-bold" for="present_{{ $stu->sl_id }}">
														P
													</label>
												</div>

												<!-- Absent -->
												<div class="form-check">
													<input 
														class="form-check-input input-absent" 
														type="radio" 
														name="attd[{{ $stu->sl_id }}]" 
														id="absent_{{ $stu->sl_id }}" 
														value="ABSENT" 
														style="cursor: pointer; accent-color: #d00226;"
														{{ (isset($marked[$stu->sl_id]) && $marked[$stu->sl_id] === 'ABSENT') ? 'checked' : '' }}
													>
													<label class="form-check-label text-danger fw-bold" for="absent_{{ $stu->sl_id }}">
														A
													</label>
												</div>

												<!-- Holiday -->
												<div class="form-check">
													<input 
														class="form-check-input input-holiday" 
														type="radio" 
														name="attd[{{ $stu->sl_id }}]" 
														id="holiday_{{ $stu->sl_id }}" 
														value="HOLIDAY" 
														style="cursor: pointer; accent-color: #f1b44c;"
														{{ (isset($marked[$stu->sl_id]) && $marked[$stu->sl_id] === 'HOLIDAY') ? 'checked' : '' }}
													>
													<label class="form-check-label text-warning fw-bold" for="holiday_{{ $stu->sl_id }}">
														H
													</label>
												</div>

												<!-- Sunday -->
												<div class="form-check">
													<input 
														class="form-check-input input-sunday" 
														type="radio" 
														name="attd[{{ $stu->sl_id }}]" 
														id="sunday_{{ $stu->sl_id }}" 
														value="SUNDAY" 
														style="cursor: pointer; accent-color: #50a5f1;"
														{{ (isset($marked[$stu->sl_id]) && $marked[$stu->sl_id] === 'SUNDAY') ? 'checked' : '' }}
													>
													<label class="form-check-label text-info fw-bold" for="sunday_{{ $stu->sl_id }}">
														S
													</label>
												</div>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<button type="submit" class="btn-save-attendance">
						<i class="fas fa-save"></i>
						Save Attendance
					</button>
				</form>
			@else
				<div class="empty-state">
					<i class="fas fa-user-slash"></i>
					<h5>No Students Found</h5>
					<p>There are no students assigned to this batch.</p>
				</div>
			@endif

		@else
			<div class="empty-state">
				<i class="fas fa-filter"></i>
				<h5>Select Batch and Date</h5>
				<p>Please select a batch and date from the filters above to mark attendance.</p>
			</div>
		@endif

	</div>
</div>

@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Check if DataTable is already initialized and destroy it first
		if ($.fn.DataTable) {
			// Destroy existing DataTable instance if it exists
			if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
				$('#datatable-buttons').DataTable().destroy();
			}
			
			// Initialize DataTable only if table exists and has data
			if ($('#datatable-buttons').length && $('#datatable-buttons tbody tr').length > 0) {
				var table = $('#datatable-buttons').DataTable({
					"order": [[0, "asc"]], // Sort by roll number
					"pageLength": 100, // Increased page length for bulk attendance
					"language": {
						"search": "",
						"searchPlaceholder": "Search students..."
					},
					"dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
				});
			}
		}
	});

	function toggleAll(status) {
		if (status === 'PRESENT') {
			$('.input-present').prop('checked', true);
		} else if (status === 'ABSENT') {
			$('.input-absent').prop('checked', true);
		} else if (status === 'HOLIDAY') {
			$('.input-holiday').prop('checked', true);
		} else if (status === 'SUNDAY') {
			$('.input-sunday').prop('checked', true);
		}
	}
</script>
@endpush
