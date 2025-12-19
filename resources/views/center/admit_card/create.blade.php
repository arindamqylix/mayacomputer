@extends('center.layouts.base')
@section('title', 'Generate Admit Card')
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
	
	.btn-create {
		background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(17, 153, 142, 0.3);
		transition: all 0.3s ease;
		width: 100%;
		font-size: 1rem;
		color: white;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 0.5rem;
	}
	
	.btn-create:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
		background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
		color: white;
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
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card modern-card">
			<div class="card-header form-header">
				<h4>
					<i class="fas fa-ticket-alt"></i>
					Admit Card Issue
				</h4>
			</div>

			<div class="card-body p-4">
				<form method="POST" id="insert_frm">
					@csrf

					<div class="row">
						<!-- LEFT SIDE -->
						<div class="col-md-6">
							<div class="form-group mb-4">
								<label>
									<i class="fas fa-id-card"></i>
									Select Registration No <span class="text-danger">*</span>
								</label>
								<select name="reg_no" class="form-select" required>
									<option value="">-- Select Student --</option>
									@foreach($students as $val)
										<option value="{{ $val->sl_id }}">
											[{{ $val->sl_reg_no }}] {{ $val->sl_name }} - {{ $val->c_full_name ?? $val->c_short_name }}
										</option>
									@endforeach
								</select>
							</div>

							<div class="form-group mb-4">
								<label>
									<i class="fas fa-calendar-alt"></i>
									Exam Date <span class="text-danger">*</span>
								</label>
								<input class="form-control" name="exam_date" type="date" required min="{{ date('Y-m-d') }}">
							</div>

							<div class="form-group mb-4">
								<label>
									<i class="fas fa-clock"></i>
									Exam Time <span class="text-danger">*</span>
								</label>
								<input class="form-control" name="exam_time" type="time" required>
							</div>
						</div>

						<!-- RIGHT SIDE -->
						<div class="col-md-6">
							<div class="form-group mb-4">
								<label>
									<i class="fas fa-map-marker-alt"></i>
									Exam Venue <span class="text-danger">*</span>
								</label>
								<input type="text" class="form-control" name="exam_venue" placeholder="Enter exam venue address" required>
							</div>

							<div class="form-group mb-4">
								<label>
									<i class="fas fa-info-circle"></i>
									Notice (Optional)
								</label>
								<input type="text" class="form-control" name="exam_notice" placeholder="Enter any special instructions or notices">
							</div>
						</div>
					</div>

					<!-- Info Card -->
					<div class="info-card">
						<h6>
							<i class="fas fa-lightbulb"></i>
							Important Information
						</h6>
						<ul>
							<li>Select a student from the dropdown to generate their admit card</li>
							<li>Ensure exam date is set to a future date</li>
							<li>Provide accurate exam venue and time details</li>
							<li>You can add special instructions in the notice field</li>
						</ul>
					</div>

					<button type="submit" class="btn-create mt-3" id="insert_btn">
						<i class="fas fa-plus-circle"></i>
						Create Admit Card
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script>
	$(document).ready(function() {
		// Set minimum date to today
		$('input[name="exam_date"]').attr('min', new Date().toISOString().split('T')[0]);
		
		// Form submission
		$('#insert_frm').on('submit', function(e) {
			$('#insert_btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Creating...');
		});
	});
</script>
@endpush
