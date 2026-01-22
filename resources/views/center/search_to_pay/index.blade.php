@extends('center.layouts.base')
@section('title', 'Search To Pay')
@push('custom-css')
<style type="text/css">
	.dataTables_wrapper{
		overflow: scroll !important;
	}
	
	/* Modern Card Header - Matching Logo Blue */
	.payment-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.payment-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.payment-header h4 i {
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
	
	/* Course Badge */
	.course-badge {
		display: inline-block;
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 0.375rem 0.75rem;
		border-radius: 6px;
		font-weight: 600;
		font-size: 0.8125rem;
		letter-spacing: 0.5px;
	}
	
	/* Amount Display */
	.amount-display {
		font-weight: 600;
		font-size: 0.9375rem;
		color: #1e3a8a;
	}
	
	.amount-display.total-fee {
		color: #2563eb;
	}
	
	.amount-display.total-paid {
		color: #11998e;
	}
	
	.amount-display.dues {
		color: #f5576c;
	}
	
	/* Action Buttons */
	.btn-pay-fee {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		color: white;
		border: none;
		padding: 0.5rem 1.25rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 0.875rem;
		cursor: pointer;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		text-decoration: none;
	}
	
	.btn-pay-fee:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(17, 153, 142, 0.4);
		color: white;
		text-decoration: none;
	}
	
	.btn-no-dues {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		border: none;
		padding: 0.5rem 1.25rem;
		border-radius: 8px;
		font-weight: 600;
		font-size: 0.875rem;
		cursor: not-allowed;
		opacity: 0.7;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
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
</style>
@endpush
@section('content')
<!-- Main Card -->
<div class="card modern-card">
	<div class="payment-header">
		<h4>
			<i class="fas fa-search-dollar"></i>
			Search To Payment
		</h4>
	</div>
	<div class="card-body" style="padding: 2rem;">
		
		<!-- Filter Section -->
		<div class="filter-section mb-4 p-4 bg-light rounded border">
			<form action="{{ route('search_to_pay') }}" method="GET" class="row align-items-end">
				<div class="col-md-8 mb-3 mb-md-0">
					<label for="course_id" class="form-label fw-bold text-dark">
						<i class="fas fa-book me-2 text-primary"></i>Filter by Course
					</label>
					<select name="course_id" id="course_id" class="form-control form-select border-2" onchange="this.form.submit()">
						<option value="">-- All Courses --</option>
						@foreach($courses as $course)
							<option value="{{ $course->c_id }}" {{ request('course_id') == $course->c_id ? 'selected' : '' }}>
								{{ $course->c_full_name }}
							</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<a href="{{ route('search_to_pay') }}" class="btn btn-secondary w-100 fw-bold">
						<i class="fas fa-redo me-2"></i>Reset Filter
					</a>
				</div>
			</form>
		</div>

		@if(count($student) > 0)
			<div class="table-responsive">
				<table id="datatable-buttons" class="table modern-table">
					<thead>
						<tr>
							<th>Reg. No</th>
							<th>Student Name</th>
							<th>Course</th>
							<th>Total Fee</th>
							<th>Total Paid</th>
							<th>Dues Amount</th>
							<th>Action</th>
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
									<span class="course-badge">{{ $data->c_short_name }}</span>
								</td>
								<td>
									<span class="amount-display total-fee">₹{{ number_format($data->sf_amount, 2) }}</span>
								</td>
								<td>
									<span class="amount-display total-paid">₹{{ number_format($data->sf_paid ?? 0, 2) }}</span>
								</td>
								<td>
									<span class="amount-display dues">₹{{ number_format($data->sf_due ?? 0, 2) }}</span>
								</td>
								<td>
									@if(($data->sf_due ?? 0) == 0)
										<button class="btn-no-dues" disabled>
											<i class="fas fa-check-circle"></i>
											No Dues
										</button>
									@else
										<a href="{{ route('fees_payment', ['student_id'=>$data->sf_FK_of_student_id]) }}" class="btn-pay-fee">
											<i class="fas fa-money-bill-wave"></i>
											Pay Fee
										</a>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@else
			<div class="empty-state">
				<i class="fas fa-user-slash"></i>
				<h5>No Students Found</h5>
				<p>There are no students with fee records to display.</p>
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
</script>
@endpush
