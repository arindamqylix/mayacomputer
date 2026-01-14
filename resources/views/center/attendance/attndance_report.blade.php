@extends('center.layouts.base')
@section('title', 'Attendance Report')

@push('custom-css')
<style>
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
	.report-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.report-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 0.75rem;
	}
	
	.report-header h4 i {
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
	
	.btn-export {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		padding: 0.625rem 1.5rem;
		border-radius: 8px;
		font-weight: 600;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		text-decoration: none;
	}
	
	.btn-export:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.4);
		color: white;
		text-decoration: none;
	}
	
	/* Month Info Card */
	.month-info-card {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border-radius: 12px;
		padding: 1.5rem;
		margin-bottom: 2rem;
		box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
	}
	
	.month-info-card h5 {
		margin: 0;
		font-weight: 600;
		display: flex;
		align-items: center;
		gap: 0.75rem;
		font-size: 1.25rem;
	}
	
	.month-info-card h5 i {
		font-size: 1.5rem;
	}
	
	/* Enhanced Table */
	.report-table {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
		font-size: 0.8125rem;
	}
	
	.report-table thead {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		position: sticky;
		top: 0;
		z-index: 10;
	}
	
	.report-table thead th {
		color: white;
		font-weight: 600;
		padding: 0.75rem 0.5rem;
		text-align: center;
		border: none;
		font-size: 0.75rem;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		white-space: nowrap;
		min-width: 40px;
	}
	
	.report-table thead th:first-child {
		text-align: left;
		padding-left: 1rem;
		position: sticky;
		left: 0;
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		z-index: 11;
		min-width: 200px;
	}
	
	.report-table tbody tr {
		transition: all 0.2s ease;
		border-bottom: 1px solid #e5e7eb;
	}
	
	.report-table tbody tr:hover {
		background: linear-gradient(90deg, #f8f9ff 0%, #ffffff 100%);
	}
	
	.report-table tbody td {
		padding: 0.75rem 0.5rem;
		color: #374151;
		text-align: center;
		vertical-align: middle;
		border-right: 1px solid #e5e7eb;
	}
	
	.report-table tbody td:first-child {
		text-align: left;
		padding-left: 1rem;
		font-weight: 600;
		color: #1e3a8a;
		position: sticky;
		left: 0;
		background: white;
		z-index: 9;
		min-width: 200px;
	}
	
	.report-table tbody tr:hover td:first-child {
		background: linear-gradient(90deg, #f8f9ff 0%, #ffffff 100%);
	}
	
	/* Status Badges */
	.badge-yes {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		padding: 0.25rem 0.5rem;
		border-radius: 4px;
		font-weight: 600;
		font-size: 0.75rem;
		display: inline-block;
		min-width: 24px;
	}
	
	.badge-no {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
		padding: 0.25rem 0.5rem;
		border-radius: 4px;
		font-weight: 600;
		font-size: 0.75rem;
		display: inline-block;
		min-width: 24px;
	}
	
	.badge-none {
		background: #e5e7eb;
		color: #6b7280;
		padding: 0.25rem 0.5rem;
		border-radius: 4px;
		font-weight: 500;
		font-size: 0.75rem;
		display: inline-block;
		min-width: 24px;
	}
	
	/* Table Wrapper */
	.table-wrapper {
		overflow-x: auto;
		max-width: 100%;
		border-radius: 8px;
		border: 1px solid #e5e7eb;
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
	
	/* Stats Cards */
	.stats-section {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
		gap: 1.5rem;
		margin-bottom: 2rem;
	}
	
	.stat-card {
		background: #fff;
		border-radius: 12px;
		padding: 1.5rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		transition: all 0.3s ease;
		border: none;
		position: relative;
		overflow: hidden;
	}
	
	.stat-card::before {
		content: '';
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		height: 4px;
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
	}
	
	.stat-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 25px rgba(0,0,0,0.12);
	}
	
	.stat-card .icon-wrapper {
		width: 60px;
		height: 60px;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 1rem;
		color: white;
		font-size: 1.5rem;
	}
	
	.stat-card .icon-wrapper.primary {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
	}
	
	.stat-card .icon-wrapper.success {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
	}
	
	.stat-card .icon-wrapper.warning {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
	}
	
	.stat-card h3 {
		font-size: 1.75rem;
		font-weight: 700;
		color: #1e3a8a;
		margin: 0 0 0.5rem 0;
	}
	
	.stat-card p {
		color: #6b7280;
		font-size: 0.875rem;
		margin: 0;
		font-weight: 500;
	}
</style>
@endpush

@section('content')

@php
	$monthName = \Carbon\Carbon::create($year, $month, 1)->format('F Y');
	$totalStudents = count($attendanceReport);
	$totalDays = count($dates);
	$totalPresent = 0;
	$totalAbsent = 0;
	foreach($attendanceReport as $student => $attRow) {
		foreach($attRow as $date => $status) {
			if($status === 'PRESENT') $totalPresent++;
			elseif($status === 'ABSENT') $totalAbsent++;
		}
	}
@endphp

<!-- Stats Cards -->
<div class="stats-section">
	<div class="stat-card">
		<div class="icon-wrapper primary">
			<i class="fas fa-users"></i>
		</div>
		<h3>{{ $totalStudents }}</h3>
		<p>Total Students</p>
	</div>
	<div class="stat-card">
		<div class="icon-wrapper success">
			<i class="fas fa-check-circle"></i>
		</div>
		<h3>{{ $totalPresent }}</h3>
		<p>Total Present</p>
	</div>
	<div class="stat-card">
		<div class="icon-wrapper warning">
			<i class="fas fa-times-circle"></i>
		</div>
		<h3>{{ $totalAbsent }}</h3>
		<p>Total Absent</p>
	</div>
	<div class="stat-card">
		<div class="icon-wrapper primary">
			<i class="fas fa-calendar"></i>
		</div>
		<h3>{{ $totalDays }}</h3>
		<p>Days in Month</p>
	</div>
</div>

<!-- Main Card -->
<div class="card modern-card">
	<div class="report-header">
		<h4>
			<span style="display: flex; align-items: center; gap: 0.75rem;">
				<i class="fas fa-chart-bar"></i>
				Attendance Report
			</span>
			<a href="javascript:void(0)" onclick="exportTable()" class="btn-export">
				<i class="fas fa-download"></i>
				Export
			</a>
		</h4>
	</div>
	<div class="card-body" style="padding: 2rem;">
		
		<!-- Filter Form -->
		<div class="filter-section">
			<form method="GET" action="{{ route('attendance_report') }}" class="row align-items-end">
				
				<div class="col-lg-3 mb-3">
					<label for="batch_id">
						<i class="fas fa-users"></i>
						Select Batch
					</label>
					<select name="batch_id" id="batch_id" class="form-control">
						<option value="">-- All Batches --</option>
						@foreach($batches as $b)
							<option value="{{ $b->ab_id }}" {{ request('batch_id') == $b->ab_id ? 'selected' : '' }}>
								{{ $b->ab_name }}
							</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-3 mb-3">
					<label for="year">
						<i class="fas fa-calendar"></i>
						Select Year
					</label>
					<select name="year" id="year" class="form-control">
						@for($y = date('Y') - 1; $y <= date('Y') + 1; $y++)
							<option value="{{ $y }}" {{ (request('year') ?? date('Y')) == $y ? 'selected' : '' }}>
								{{ $y }}
							</option>
						@endfor
					</select>
				</div>

				<div class="col-lg-3 mb-3">
					<label for="month">
						<i class="fas fa-calendar-alt"></i>
						Select Month
					</label>
					<select name="month" id="month" class="form-control">
						@foreach(range(1, 12) as $m)
							<option value="{{ $m }}" {{ (request('month') ?? date('n')) == $m ? 'selected' : '' }}>
								{{ \Carbon\Carbon::create()->month($m)->format('F') }}
							</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-3 mb-3">
					<button type="submit" class="btn-filter w-100">
						<i class="fas fa-filter"></i> Apply Filter
					</button>
				</div>
			</form>
		</div>

		<!-- Month Info Card -->
		<div class="month-info-card">
			<h5>
				<i class="fas fa-calendar-check"></i>
				Attendance Report for {{ $monthName }}
			</h5>
		</div>

		<!-- Attendance Table -->
		@if(count($attendanceReport) > 0)
			<div class="table-wrapper">
				<table id="attendance-report-table" class="table report-table">
					<thead>
						<tr>
							<th>Student Name</th>
							@foreach ($dates as $d)
								<th>{{ \Carbon\Carbon::parse($d)->format('d') }}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach($attendanceReport as $student => $attRow)
							<tr>
								<td>{{ $student }}</td>
								@foreach ($dates as $d)
									@php 
										$val = $attRow[$d] ?? null;
										$status = '';
										if($val === 'PRESENT' || $val === 'Yes') {
											$status = 'PRESENT';
										} elseif($val === 'ABSENT' || $val === 'No') {
											$status = 'ABSENT';
										} else {
											$status = 'NONE';
										}
									@endphp
									<td>
										@if($status === 'PRESENT')
											<span class="badge-yes">✔</span>
										@elseif($status === 'ABSENT')
											<span class="badge-no">✘</span>
										@else
											<span class="badge-none">-</span>
										@endif
									</td>
								@endforeach
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			<div class="empty-state">
				<i class="fas fa-chart-line"></i>
				<h5>No Attendance Data</h5>
				<p>No attendance records found for the selected month.</p>
			</div>
		@endif

	</div>
</div>

@endsection

@push('custom-js')
<script>
	function exportTable() {
		let table = document.getElementById('attendance-report-table');
		if (!table) {
			alert('No table visible to export.');
			return;
		}

		// Build CSV
		let csv = [];
		for (let r = 0; r < table.rows.length; r++) {
			let row = [], cols = table.rows[r].querySelectorAll('th, td');
			for (let c = 0; c < cols.length; c++) {
				let text = cols[c].innerText.replace(/\n/g, ' ').trim();
				// Replace badges with text
				if (text === '✔') text = 'PRESENT';
				else if (text === '✘') text = 'ABSENT';
				else if (text === '-') text = 'N/A';
				// Sanitize quotes
				text = text.replace(/"/g, '""');
				row.push('"' + text + '"');
			}
			csv.push(row.join(','));
		}

		let csvContent = csv.join('\n');
		let filename = 'attendance_report_{{ $monthName }}_' + (new Date()).toISOString().slice(0,10) + '.csv';

		// Download
		let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
		if (navigator.msSaveBlob) {
			navigator.msSaveBlob(blob, filename);
		} else {
			let link = document.createElement("a");
			let url = URL.createObjectURL(blob);
			link.setAttribute("href", url);
			link.setAttribute("download", filename);
			link.style.visibility = 'hidden';
			document.body.appendChild(link);
			link.click();
			document.body.removeChild(link);
		}
	}
</script>
@endpush
