@extends('center.layouts.base')
@section('title', 'Set Fee')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
	.fee-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.fee-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.fee-header h4 i {
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
	
	/* Course Selector */
	.course-selector-section {
		background: #fff;
		border-radius: 12px;
		padding: 1.5rem;
		box-shadow: 0 4px 15px rgba(0,0,0,0.08);
		margin-bottom: 2rem;
		border: 1px solid #e5e7eb;
	}
	
	.course-selector-section label {
		font-weight: 600;
		color: #1e3a8a;
		margin-bottom: 0.75rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
		font-size: 1rem;
	}
	
	.course-selector-section label i {
		color: #2563eb;
		font-size: 1.25rem;
	}
	
	.course-selector-section select {
		border: 2px solid #e5e7eb;
		border-radius: 8px;
		padding: 0.75rem 1rem;
		font-size: 1rem;
		transition: all 0.3s ease;
		background: #fff;
		color: #1e3a8a;
		font-weight: 500;
	}
	
	.course-selector-section select:focus {
		border-color: #2563eb;
		outline: none;
		box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
	
	/* Mobile Number */
	.mobile-number {
		color: #6b7280;
		font-family: 'Courier New', monospace;
		font-size: 0.875rem;
	}
	
	/* Fee Input Group */
	.fee-input-group {
		display: flex;
		gap: 0.75rem;
		align-items: center;
	}
	
	.fee-input-wrapper {
		position: relative;
		flex: 1;
		max-width: 200px;
	}
	
	.fee-input-wrapper::before {
		content: '₹';
		position: absolute;
		left: 0.75rem;
		top: 50%;
		transform: translateY(-50%);
		color: #6b7280;
		font-weight: 600;
		font-size: 1rem;
		z-index: 1;
	}
	
	.fee-input-wrapper input {
		width: 100%;
		padding: 0.625rem 0.75rem 0.625rem 2rem;
		border: 2px solid #e5e7eb;
		border-radius: 8px;
		font-size: 0.9375rem;
		font-weight: 600;
		color: #1e3a8a;
		transition: all 0.3s ease;
		background: #fff;
	}
	
	.fee-input-wrapper input:focus {
		border-color: #2563eb;
		outline: none;
		box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
	}
	
	/* Set Fee Button */
	.btn-set-fee {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		padding: 0.625rem 1.25rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 0.875rem;
		cursor: pointer;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		white-space: nowrap;
	}
	
	.btn-set-fee:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.4);
	}
	
	.btn-set-fee:active {
		transform: translateY(0);
	}
	
	.btn-set-fee i {
		font-size: 0.875rem;
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
	
	/* Loading State */
	.btn-set-fee.loading {
		opacity: 0.7;
		pointer-events: none;
	}
	
	.btn-set-fee.loading::after {
		content: '';
		width: 14px;
		height: 14px;
		border: 2px solid rgba(255,255,255,0.3);
		border-top-color: white;
		border-radius: 50%;
		animation: spin 0.6s linear infinite;
		display: inline-block;
		margin-left: 0.5rem;
	}
	
	@keyframes spin {
		to { transform: rotate(360deg); }
	}
</style>
@endpush
@section('content')
<!-- Stats Cards -->
@if(request()->get('course_id'))
	@php
		$totalStudents = count($student);
		$totalFeeAmount = collect($student)->sum('c_price');
	@endphp
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
				<i class="fas fa-rupee-sign"></i>
			</div>
			<h3>₹{{ number_format($totalFeeAmount, 2) }}</h3>
			<p>Total Course Fee</p>
		</div>
		<div class="stat-card">
			<div class="icon-wrapper warning">
				<i class="fas fa-book"></i>
			</div>
			<h3>
				@php
					$selectedCourse = collect($course)->where('c_id', request()->get('course_id'))->first();
				@endphp
				{{ $selectedCourse->c_short_name ?? 'N/A' }}
			</h3>
			<p>Selected Course</p>
		</div>
	</div>
@endif

<!-- Course Selector -->
<div class="course-selector-section">
	<form method="GET" action="{{ route('set_fee') }}">
		<label for="course_id">
			<i class="fas fa-graduation-cap"></i>
			Select Course to Set Fees
		</label>
		<select name="course_id" id="course_id" class="form-control" onchange="this.form.submit()">
			<option value="">-- Select Course --</option>
			@foreach($course as $data)
				<option value="{{ $data->c_id }}" @if(request()->get('course_id') == $data->c_id) selected @endif>
					{{ $data->c_short_name }} - {{ $data->c_full_name }}
				</option>
			@endforeach
		</select>
	</form>
</div>

<!-- Main Card -->
<div class="card modern-card">
	<div class="fee-header">
		<h4>
			<i class="fas fa-money-bill-wave"></i>
			Set Student Fees
		</h4>
	</div>
	<div class="card-body" style="padding: 1.5rem;">
		@if(request()->get('course_id') && count($student) > 0)
			<div class="table-responsive">
				<table id="datatable-buttons" class="table modern-table">
					<thead>
						<tr>
							<th>Reg. No</th>
							<th>Student Name</th>
							<th>Mobile No</th>
							<th>Course Fee</th>
						</tr>
					</thead>
					<tbody>
						@foreach($student as $data)
							<tr>
								<td>
									<span class="reg-badge">{{ $data->sl_reg_no }}</span>
								</td>
								<td>
									<span class="student-name">{{ $data->sl_name }}</span>
								</td>
								<td>
									<span class="mobile-number">{{ $data->sl_mobile_no }}</span>
								</td>
								<td>
									<div class="fee-input-group">
										<div class="fee-input-wrapper">
											<input 
												type="number" 
												id="fees_amount_{{ $data->sl_id }}" 
												name="fees" 
												value="{{ $data->c_price }}"
												min="0"
												step="0.01"
											>
										</div>
										<button 
											type="button"
											onclick="set_fee({{ $data->sl_id }})" 
											class="btn-set-fee"
											id="btn_set_fee_{{ $data->sl_id }}"
										>
											<i class="fas fa-check-circle"></i>
											Set Fee
										</button>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@elseif(request()->get('course_id') && count($student) == 0)
			<div class="empty-state">
				<i class="fas fa-user-slash"></i>
				<h5>No Students Found</h5>
				<p>There are no students enrolled in the selected course.</p>
			</div>
		@else
			<div class="empty-state">
				<i class="fas fa-graduation-cap"></i>
				<h5>Select a Course</h5>
				<p>Please select a course from the dropdown above to view and set student fees.</p>
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
			
			// Initialize DataTable only if table exists
			if ($('#datatable-buttons').length && $('#datatable-buttons tbody tr').length > 0) {
				var table = $('#datatable-buttons').DataTable({
					"order": [[0, "asc"]], // Sort by registration number
					"pageLength": 25,
					"language": {
						"search": "",
						"searchPlaceholder": "Search students..."
					},
					"dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
				});
			}
		}
	});
	
	function set_fee(student_id) {
		var fees_amount = $('#fees_amount_' + student_id).val();
		var btn = $('#btn_set_fee_' + student_id);
		
		// Validate input
		if (!fees_amount || fees_amount <= 0) {
			alert('Please enter a valid fee amount');
			return;
		}
		
		// Show loading state
		btn.addClass('loading');
		btn.prop('disabled', true);
		
		$.ajax({
			url: "{{ route('set_fee_amount') }}",
			type: "GET",
			data: {
				student_id: student_id,
				fees_amount: fees_amount
			},
			dataType: "json",
			success: function(response) {
				// Remove loading state
				btn.removeClass('loading');
				btn.prop('disabled', false);
				
				if (response.status == 1) {
					// Show success message
					showSuccessAlert(response.msg);
					
					// Optional: Update button to show success state
					btn.html('<i class="fas fa-check"></i> Fee Set');
					setTimeout(function() {
						btn.html('<i class="fas fa-check-circle"></i> Set Fee');
					}, 2000);
				} else {
					alert('Error: ' + (response.msg || 'Failed to set fee'));
				}
			},
			error: function(xhr, status, error) {
				// Remove loading state
				btn.removeClass('loading');
				btn.prop('disabled', false);
				
				alert('Error: Failed to set fee. Please try again.');
				console.error('Error:', error);
			}
		});
	}
	
	function showSuccessAlert(message) {
		// Remove existing alerts
		$('.alert-success-custom').remove();
		
		// Create success alert
		var alert = $('<div class="alert-success-custom">' +
			'<i class="fas fa-check-circle"></i>' +
			'<span>' + message + '</span>' +
			'</div>');
		
		// Insert before the card
		$('.modern-card').before(alert);
		
		// Auto remove after 3 seconds
		setTimeout(function() {
			alert.fadeOut(300, function() {
				$(this).remove();
			});
		}, 3000);
	}
</script>
@endpush
