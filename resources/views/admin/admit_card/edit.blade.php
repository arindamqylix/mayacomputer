@extends('admin.layouts.base')
@section('title', 'Edit Admit Card')
@push('custom-css')
<style type="text/css">
	/* Modern Form Styling */
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	.form-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.form-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.form-header h4 i {
		font-size: 1.75rem;
	}
	
	.form-group label {
		font-weight: 600;
		color: #495057;
		margin-bottom: 0.5rem;
		font-size: 0.875rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.form-group label .text-danger {
		color: #dc2626;
	}
	
	.form-control, .form-select {
		border-radius: 0.5rem;
		border: 1px solid #dee2e6;
		padding: 0.75rem 1rem;
		transition: all 0.3s ease;
		font-size: 1rem;
	}
	
	.form-control:focus, .form-select:focus {
		border-color: #2563eb;
		box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
		outline: none;
	}
	
	.btn-update {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
		transition: all 0.3s ease;
		width: 100%;
		font-size: 1rem;
		color: white;
	}
	
	.btn-update:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(37, 99, 235, 0.4);
		background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
		color: white;
	}
	
	.btn-view-all {
		background: #6c757d;
		border: none;
		padding: 0.75rem 1.5rem;
		border-radius: 0.5rem;
		font-weight: 600;
		transition: all 0.3s ease;
		color: white;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-view-all:hover {
		background: #5a6268;
		transform: translateY(-2px);
		color: white;
		text-decoration: none;
	}
	
	/* Icon Wrapper */
	.icon-wrapper {
		width: 50px;
		height: 50px;
		border-radius: 12px;
		background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 1rem;
	}
	
	.icon-wrapper i {
		font-size: 1.5rem;
		color: #2563eb;
	}
	
	/* Info Card */
	.info-card {
		background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
		border: 2px solid #e9ecef;
		border-radius: 12px;
		padding: 1.5rem;
		margin-top: 1.5rem;
	}
	
	.info-card h6 {
		color: #1e3a8a;
		font-weight: 600;
		margin-bottom: 0.75rem;
		display: flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.info-card ul {
		margin: 0;
		padding-left: 1.5rem;
		color: #6c757d;
	}
	
	.info-card ul li {
		margin-bottom: 0.5rem;
	}
	
	/* Select Dropdown Enhancement */
	.form-select {
		background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
		background-repeat: no-repeat;
		background-position: right 0.75rem center;
		background-size: 16px 12px;
		padding-right: 2.5rem;
	}
	
	/* Input Icons */
	.input-icon-wrapper {
		position: relative;
	}
	
	.input-icon-wrapper i {
		position: absolute;
		left: 1rem;
		top: 50%;
		transform: translateY(-50%);
		color: #6c757d;
		z-index: 1;
	}
	
	.input-icon-wrapper .form-control {
		padding-left: 2.5rem;
	}
	
	/* Current Info Display */
	.current-info {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		color: white;
		padding: 1rem;
		border-radius: 0.5rem;
		margin-bottom: 1.5rem;
	}
	
	.current-info h6 {
		margin: 0 0 0.5rem 0;
		font-size: 0.875rem;
		opacity: 0.9;
	}
	
	.current-info p {
		margin: 0;
		font-size: 1rem;
		font-weight: 600;
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-10 offset-lg-1">
		<div class="card modern-card">
			<div class="card-header form-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-edit"></i>
						Edit Admit Card
					</h4>
					<a href="{{ route('admin.admit_card_list') }}" class="btn-view-all">
						<i class="fas fa-list"></i>
						View All Admit Cards
					</a>
				</div>
			</div>
			
			<div class="card-body p-4">
				@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="fas fa-check-circle me-2"></i>
						{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				@if(session('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="fas fa-exclamation-circle me-2"></i>
						{{ session('error') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				@endif

				<form method="POST" action="{{ route('admin.update_admit_card', $admit->ac_id) }}" id="update_frm">
					@csrf
					
					<div class="row">
						<!-- LEFT SIDE -->
						<div class="col-md-6">
							<div class="icon-wrapper">
								<i class="fas fa-user-graduate"></i>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-id-card"></i>
									Select Registration No <span class="text-danger">*</span>
								</label>
								<select name="reg_no" class="form-select" required>
									<option value="">-- Select Student --</option>
									@foreach($students as $val)
										<option value="{{ $val->sl_id }}" 
											{{ $admit->student_id == $val->sl_id ? 'selected' : '' }}>
											[{{ $val->sl_reg_no }}] {{ $val->sl_name }} - {{ $val->c_full_name }} 
											@if(isset($val->center_name)) ({{ $val->center_name }}) @endif
										</option>
									@endforeach
								</select>
								<small class="form-text text-muted mt-1">
									<i class="fas fa-info-circle me-1"></i>
									You can change the student if needed
								</small>
							</div>

							<div class="form-group mb-3">
								<label>
									<i class="fas fa-calendar-alt"></i>
									Exam Date <span class="text-danger">*</span>
								</label>
								<div class="input-icon-wrapper">
									<i class="fas fa-calendar"></i>
									<input class="form-control" name="exam_date" type="date" 
									       value="{{ $admit->exam_date }}" required>
								</div>
							</div>

							<div class="form-group mb-3">
								<label>
									<i class="fas fa-clock"></i>
									Exam Time <span class="text-danger">*</span>
								</label>
								<div class="input-icon-wrapper">
									<i class="fas fa-clock"></i>
									<input class="form-control" name="exam_time" type="time" 
									       value="{{ $admit->exam_time }}" required>
								</div>
							</div>
						</div>

						<!-- RIGHT SIDE -->
						<div class="col-md-6">
							<div class="icon-wrapper">
								<i class="fas fa-map-marker-alt"></i>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-map-pin"></i>
									Exam Venue <span class="text-danger">*</span>
								</label>
								<div class="input-icon-wrapper">
									<i class="fas fa-building"></i>
									<input type="text" class="form-control" 
									       name="exam_venue" value="{{ $admit->exam_venue }}" 
									       placeholder="Enter exam venue address" required>
								</div>
							</div>

							<div class="form-group mb-3">
								<label>
									<i class="fas fa-info-circle"></i>
									Notice / Instructions
								</label>
								<textarea class="form-control" name="exam_notice" rows="4" 
								          placeholder="Enter any special instructions or notices for the exam...">{{ $admit->exam_notice ?? '' }}</textarea>
								<small class="form-text text-muted mt-1">
									<i class="fas fa-info-circle me-1"></i>
									Optional: Add any important notices or instructions for students
								</small>
							</div>
						</div>
					</div>
					
					<div class="info-card">
						<h6>
							<i class="fas fa-lightbulb"></i>
							Important Information
						</h6>
						<ul>
							<li>Changes will be reflected immediately on the admit card</li>
							<li>Make sure all exam details are accurate before updating</li>
							<li>Students will see the updated information when they view their admit card</li>
							<li>You can print the updated admit card after saving changes</li>
						</ul>
					</div>

					<div class="mt-4">
						<button type="submit" class="btn btn-update" id="update_btn">
							<i class="fas fa-save me-2"></i>
							Update Admit Card
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Form submission handler
		$('#update_frm').on('submit', function(e) {
			const regNo = $('select[name="reg_no"]').val();
			const examDate = $('input[name="exam_date"]').val();
			const examTime = $('input[name="exam_time"]').val();
			const examVenue = $('input[name="exam_venue"]').val();
			
			if (!regNo || !examDate || !examTime || !examVenue) {
				e.preventDefault();
				if (typeof toastr !== 'undefined') {
					toastr.error('Please fill in all required fields');
				} else {
					alert('Please fill in all required fields');
				}
				return false;
			}
			
			// Check if exam date is in the past
			const selectedDate = new Date(examDate);
			const today = new Date();
			today.setHours(0, 0, 0, 0);
			
			if (selectedDate < today) {
				if (!confirm('The exam date is in the past. Are you sure you want to continue?')) {
					e.preventDefault();
					return false;
				}
			}
			
			$('#update_btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...');
		});
		
		// Date input enhancement
		$('input[name="exam_date"]').on('change', function() {
			const selectedDate = new Date($(this).val());
			const today = new Date();
			today.setHours(0, 0, 0, 0);
			
			if (selectedDate < today) {
				$(this).addClass('border-warning');
				if ($(this).parent().next('.text-warning').length === 0) {
					$('<small class="text-warning d-block mt-1"><i class="fas fa-exclamation-triangle me-1"></i>Selected date is in the past</small>')
						.insertAfter($(this).parent());
				}
			} else {
				$(this).removeClass('border-warning');
				$(this).parent().next('.text-warning').remove();
			}
		});
	});
</script>
@endpush
