@extends('admin.layouts.base')
@section('title', 'Courier Management')
@push('custom-css')
<style type="text/css">
	.courier-header {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.courier-header h4 {
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
	
	.center-select-section {
		background: #f8f9fa;
		padding: 1.5rem;
		border-bottom: 1px solid #e9ecef;
	}
	
	.form-group label {
		font-weight: 600;
		color: #495057;
		margin-bottom: 0.5rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.form-control, .form-select {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.75rem 1rem;
		transition: all 0.3s ease;
	}
	
	.form-control:focus, .form-select:focus {
		border-color: #f59e0b;
		box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
		outline: none;
	}
	
	.modern-table thead th {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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
	
	.modern-table tbody tr:hover {
		background-color: #f8f9ff;
	}
	
	.student-checkbox {
		width: 20px;
		height: 20px;
		cursor: pointer;
	}
	
	.dispatch-form-section {
		background: #fff3cd;
		border: 2px solid #ffc107;
		border-radius: 0.5rem;
		padding: 1.5rem;
		margin-top: 2rem;
		display: none;
	}
	
	.dispatch-form-section.active {
		display: block;
	}
	
	.total-docs {
		font-size: 1.25rem;
		font-weight: 700;
		color: #f59e0b;
	}
	
	.btn-dispatch-multiple {
		background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
		color: white;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		border: none;
		transition: all 0.3s ease;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-dispatch-multiple:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(245, 158, 11, 0.4);
		color: white;
	}
	
	.badge-pending {
		background-color: #fee2e2;
		color: #991b1b;
		padding: 0.25rem 0.75rem;
		border-radius: 0.25rem;
		font-size: 0.75rem;
		font-weight: 600;
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="courier-header">
					<h4>
						<i class="fas fa-truck"></i>
						Courier Management
					</h4>
				</div>

				<!-- Center Selection Section -->
				<div class="center-select-section">
					<form method="GET" action="{{ route('admin.courier.index') }}" id="centerSelectForm">
						<input type="hidden" name="view" value="{{ $viewType ?? 'dashboard' }}">
						<div class="row align-items-end">
							<div class="col-md-5">
								<div class="form-group mb-0">
									<label for="center_id">
										<i class="fas fa-building"></i>
										Select Center (for details)
									</label>
									<select name="center_id" id="center_id" class="form-select" onchange="document.getElementById('centerSelectForm').submit();">
										<option value="">-- View Global Dashboard --</option>
										@foreach($centers as $center)
											<option value="{{ $center->cl_id }}" {{ $selectedCenterId == $center->cl_id ? 'selected' : '' }}>
												{{ $center->cl_center_name ?? $center->cl_name }} ({{ $center->cl_code }})
											</option>
										@endforeach
									</select>
								</div>
							</div>
							
							<div class="col-md-7">
								<div class="btn-group w-100" role="group">
									<a href="{{ route('admin.courier.index', array_merge(request()->query(), ['view' => 'dashboard'])) }}" 
									   class="btn {{ ($viewType ?? 'dashboard') == 'dashboard' ? 'btn-primary' : 'btn-outline-primary' }}">
										<i class="fas fa-chart-pie me-2"></i> Dashboard
									</a>
									<a href="{{ route('admin.courier.index', array_merge(request()->query(), ['view' => 'pending'])) }}" 
									   class="btn {{ ($viewType ?? 'dashboard') == 'pending' ? 'btn-primary' : 'btn-outline-primary' }}">
										<i class="fas fa-clock me-2"></i> Pending
									</a>
									<a href="{{ route('admin.courier.index', array_merge(request()->query(), ['view' => 'history'])) }}" 
									   class="btn {{ ($viewType ?? 'dashboard') == 'history' ? 'btn-primary' : 'btn-outline-primary' }}">
										<i class="fas fa-history me-2"></i> History
									</a>
								</div>
							</div>
						</div>
					</form>
				</div>

				<div class="card-body">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif
					
					@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							{{ session('error') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						</div>
					@endif

					@if(($viewType ?? 'dashboard') === 'dashboard')
						<!-- Global Shipments Dashboard -->
						<div class="table-responsive">
							<table class="table modern-table" id="shipmentsTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Dispatch Date</th>
										<th>Center Details</th>
										<th>Tracking Number</th>
										<th>Items</th>
										<th>Status</th>
										<th>Days</th>
									</tr>
								</thead>
								<tbody>
									@forelse($shipments as $index => $shipment)
										<tr>
											<td>{{ $index + 1 }}</td>
											<td>
												{{ \Carbon\Carbon::parse($shipment->sc_dispatch_date)->format('d M, Y') }}
											</td>
											<td>
												<strong class="text-primary">{{ $shipment->cl_center_name }}</strong><br>
												<span class="text-muted small">{{ $shipment->cl_code }}</span>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="me-2">
														<i class="fas fa-barcode text-secondary"></i>
													</div>
													<div>
														<span class="fw-bold">{{ $shipment->sc_tracking_number }}</span><br>
														<span class="text-muted small">{{ $shipment->sc_dispatch_thru }}</span>
													</div>
												</div>
											</td>
											<td>
												<span class="badge bg-info text-dark">{{ $shipment->total_items }} Student(s)</span>
											</td>
											<td>
												@if($shipment->courier_status === 'RECEIVED')
													<span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> RECEIVED</span>
												@else
													<span class="badge bg-warning text-dark"><i class="fas fa-truck me-1"></i> IN TRANSIT</span>
												@endif
											</td>
											<td>
												@php
													$dispatchDate = \Carbon\Carbon::parse($shipment->sc_dispatch_date);
													$days = $dispatchDate->diffInDays(now());
												@endphp
												@if($shipment->courier_status === 'RECEIVED')
													<span class="text-success small">Completed</span>
												@else
													<span class="small {{ $days > 5 ? 'text-danger fw-bold' : 'text-muted' }}">
														{{ $days }} Day(s) ago
													</span>
												@endif
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="7" class="text-center py-5">
												<i class="fas fa-truck fa-3x text-muted mb-3 opacity-25"></i>
												<h5 class="text-muted">No shipments found</h5>
												<p class="text-muted small">Dispatched items will appear here.</p>
											</td>
										</tr>
									@endforelse
								</tbody>
							</table>
						</div>

					@elseif($students->count() > 0)
						<div class="table-responsive">
							<table class="table modern-table" id="studentsTable">
								<thead>
									<tr>
										@if(($viewType ?? 'pending') == 'pending')
											<th>
												<input type="checkbox" id="selectAll" class="student-checkbox" title="Select All">
											</th>
										@endif
										<th>#</th>
										<th>Student Name</th>
										<th>Registration No.</th>
										<th>Course</th>
										<th>Certificate No.</th>
										
										@if(($viewType ?? 'pending') == 'history')
											<th>Dispatch Date</th>
											<th>Tracking Info</th>
											<th>Status</th>
											<th>Action</th>
										@else
											<th>Issue Date</th>
											<th>Status</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($students as $student)
										<tr>
											@if(($viewType ?? 'pending') == 'pending')
												<td>
													<input type="checkbox" 
														   name="student_ids[]" 
														   value="{{ $student->sl_id }}" 
														   class="student-checkbox student-checkbox-item"
														   data-certificate-id="{{ $student->certificate_id }}">
												</td>
											@endif
											<td>{{ $i++ }}</td>
											<td>{{ $student->sl_name ?? 'N/A' }}</td>
											<td>{{ $student->sl_reg_no ?? 'N/A' }}</td>
											<td>{{ $student->c_short_name ?? $student->c_full_name ?? 'N/A' }}</td>
											<td><strong>{{ $student->sc_certificate_number ?? 'N/A' }}</strong></td>
											
											@if(($viewType ?? 'pending') == 'history')
												<td>
													{{ \Carbon\Carbon::parse($student->sc_dispatch_date)->format('d-M-Y') }}
												</td>
												<td>
													<div style="font-size: 0.85rem;">
														<strong>{{ $student->sc_tracking_number }}</strong><br>
														<span class="text-muted">{{ $student->sc_dispatch_thru }}</span>
													</div>
												</td>
												<td>
													@if($student->courier_status === 'RECEIVED')
														<span class="badge bg-success">RECEIVED</span>
													@else
														<span class="badge bg-warning text-dark">DISPATCHED</span>
													@endif
												</td>
												<td>
													<button type="button" 
															class="btn btn-sm btn-info text-white btn-edit-courier"
															data-bs-toggle="modal" 
															data-bs-target="#editCourierModal"
															data-id="{{ $student->certificate_id }}"
															data-dispatch-thru="{{ $student->sc_dispatch_thru }}"
															data-dispatch-date="{{ $student->sc_dispatch_date }}"
															data-tracking-number="{{ $student->sc_tracking_number }}"
															data-status="{{ $student->courier_status }}">
														<i class="fas fa-edit"></i> Edit
													</button>
												</td>
											@else
												<td>
													@if($student->sc_issue_date)
														{{ \Carbon\Carbon::parse($student->sc_issue_date)->format('d-M-Y') }}
													@else
														<span class="text-muted">N/A</span>
													@endif
												</td>
												<td>
													<span class="badge-pending">Pending Dispatch</span>
												</td>
											@endif
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						
						@if(($viewType ?? 'pending') == 'pending')
							<!-- Dispatch Form Section -->
							<div class="dispatch-form-section" id="dispatchFormSection">
								<h5 class="mb-3">
									<i class="fas fa-truck"></i>
									Dispatch Selected Documents
								</h5>
								
								<div class="mb-3">
									<strong>Total Documents Selected: <span class="total-docs" id="totalDocs">0</span></strong>
								</div>
								
								<form action="{{ route('admin.courier.update') }}" method="POST" id="dispatchForm">
									@csrf
									<input type="hidden" name="student_ids[]" id="selectedStudentIds" value="">
									
									<div class="row">
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label for="dispatch_thru">
													<i class="fas fa-truck"></i>
													Dispatch Thru (Courier/Company Name) <span class="text-danger">*</span>
												</label>
												<input type="text" 
													   class="form-control" 
													   id="dispatch_thru" 
													   name="dispatch_thru" 
													   placeholder="e.g., Blue Dart, DTDC, India Post" 
													   required>
											</div>
										</div>
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label for="dispatch_date">
													<i class="fas fa-calendar-alt"></i>
													Dispatch Date <span class="text-danger">*</span>
												</label>
												<input type="date" 
													   class="form-control" 
													   id="dispatch_date" 
													   name="dispatch_date" 
													   value="{{ date('Y-m-d') }}"
													   required>
											</div>
										</div>
										
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<label for="tracking_number">
													<i class="fas fa-barcode"></i>
													Tracking Number <span class="text-danger">*</span>
												</label>
												<input type="text" 
													   class="form-control" 
													   id="tracking_number" 
													   name="tracking_number" 
													   placeholder="Enter tracking/AWB number" 
													   required>
											</div>
										</div>
									</div>
									
									<div class="mt-3">
										<button type="submit" class="btn-dispatch-multiple">
											<i class="fas fa-save"></i>
											Dispatch Selected Documents
										</button>
									</div>
								</form>
							</div>
						@endif
						
					@elseif(($viewType ?? 'dashboard') != 'dashboard' && $students->count() == 0)
						<div class="alert alert-info text-center">
							<i class="fas fa-info-circle"></i>
							No documents found for this view.
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Edit Courier Modal -->
<div class="modal fade" id="editCourierModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title">Edit Courier Details</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="editCourierForm" method="POST">
				@csrf
				<div class="modal-body">
					<div class="mb-3">
						<label for="edit_dispatch_thru" class="form-label">Dispatch Thru</label>
						<input type="text" class="form-control" id="edit_dispatch_thru" name="dispatch_thru" required>
					</div>
					<div class="mb-3">
						<label for="edit_dispatch_date" class="form-label">Dispatch Date</label>
						<input type="date" class="form-control" id="edit_dispatch_date" name="dispatch_date" required>
					</div>
					<div class="mb-3">
						<label for="edit_tracking_number" class="form-label">Tracking Number</label>
						<input type="text" class="form-control" id="edit_tracking_number" name="tracking_number" required>
					</div>
					<div class="mb-3">
						<label for="edit_courier_status" class="form-label">Status</label>
						<select class="form-select" id="edit_courier_status" name="courier_status" required>
							<option value="DISPATCHED">DISPATCHED</option>
							<option value="RECEIVED">RECEIVED</option>
							<option value="RETURNED">RETURNED</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update Details</button>
				</div>
			</form>
		</div>
	</div>
</div>

@push('custom-script')
<script>
	$(document).ready(function() {
		// Select All functionality
		$('#selectAll').on('change', function() {
			$('.student-checkbox-item').prop('checked', this.checked);
			updateTotalDocs();
		});
		
		// Individual checkbox change
		$('.student-checkbox-item').on('change', function() {
			// Update select all checkbox state
			var totalCheckboxes = $('.student-checkbox-item').length;
			var checkedCheckboxes = $('.student-checkbox-item:checked').length;
			$('#selectAll').prop('checked', totalCheckboxes === checkedCheckboxes);
			
			updateTotalDocs();
		});
		
		// Update total documents count
		function updateTotalDocs() {
			var selectedCount = $('.student-checkbox-item:checked').length;
			$('#totalDocs').text(selectedCount);
			
			if (selectedCount > 0) {
				$('#dispatchFormSection').addClass('active');
				
				// Update hidden input with selected student IDs
				var selectedIds = [];
				$('.student-checkbox-item:checked').each(function() {
					selectedIds.push($(this).val());
				});
				
				// Update form to include all selected IDs
				var formHtml = '';
				selectedIds.forEach(function(id) {
					formHtml += '<input type="hidden" name="student_ids[]" value="' + id + '">';
				});
				$('#selectedStudentIds').remove();
				$('#dispatchForm').prepend(formHtml);
			} else {
				$('#dispatchFormSection').removeClass('active');
			}
		}
		
		// Edit Courier Modal Data Population
		$('.btn-edit-courier').on('click', function() {
			var id = $(this).data('id');
			var dispatchThru = $(this).data('dispatch-thru');
			var dispatchDate = $(this).data('dispatch-date');
			var trackingNumber = $(this).data('tracking-number');
			var status = $(this).data('status');
			
			// Format date to YYYY-MM-DD for input type="date"
			var formattedDate = '';
			if(dispatchDate) {
				var d = new Date(dispatchDate);
				var month = '' + (d.getMonth() + 1);
				var day = '' + d.getDate();
				var year = d.getFullYear();

				if (month.length < 2) month = '0' + month;
				if (day.length < 2) day = '0' + day;

				formattedDate = [year, month, day].join('-');
			}

			$('#edit_dispatch_thru').val(dispatchThru);
			$('#edit_dispatch_date').val(formattedDate);
			$('#edit_tracking_number').val(trackingNumber);
			$('#edit_courier_status').val(status);
			
			// Set form action
			var actionUrl = "{{ route('admin.courier.update_details', ':id') }}";
			actionUrl = actionUrl.replace(':id', id);
			$('#editCourierForm').attr('action', actionUrl);
		});

		// Initialize on page load
		updateTotalDocs();
	});
</script>
@endpush
