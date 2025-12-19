@extends('center.layouts.base')
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
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 0.5rem;
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
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card modern-card">
			<div class="card-header form-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4>
						<i class="fas fa-edit"></i>
						Edit Admit Card
					</h4>
					<a href="{{ route('admit_card_list') }}" class="btn-view-all">
						<i class="fas fa-list"></i>
						View All
					</a>
				</div>
			</div>

			<div class="card-body p-4">
				<form method="POST" action="{{ route('update_admit_card', $admit->ac_id) }}" id="update_frm">
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
										<option value="{{ $val->sl_id }}" {{ $admit->student_id == $val->sl_id ? 'selected' : '' }}>
											[{{ $val->sl_reg_no }}] {{ $val->sl_name }} - {{ $val->c_full_name }}
										</option>
									@endforeach
								</select>
							</div>

							<div class="form-group mb-4">
								<label>
									<i class="fas fa-calendar-alt"></i>
									Exam Date <span class="text-danger">*</span>
								</label>
								<input class="form-control" name="exam_date" type="date" value="{{ $admit->exam_date }}" required>
							</div>

							<div class="form-group mb-4">
								<label>
									<i class="fas fa-clock"></i>
									Exam Time <span class="text-danger">*</span>
								</label>
								<input class="form-control" name="exam_time" type="time" value="{{ $admit->exam_time }}" required>
							</div>
						</div>

						<!-- RIGHT SIDE -->
						<div class="col-md-6">
							<div class="form-group mb-4">
								<label>
									<i class="fas fa-map-marker-alt"></i>
									Exam Venue <span class="text-danger">*</span>
								</label>
								<input type="text" class="form-control" name="exam_venue" value="{{ $admit->exam_venue }}" required>
							</div>

							<div class="form-group mb-4">
								<label>
									<i class="fas fa-info-circle"></i>
									Notice (Optional)
								</label>
								<input type="text" class="form-control" name="exam_notice" value="{{ $admit->exam_notice }}">
							</div>
						</div>
					</div>

					<button type="submit" class="btn-update mt-3" id="update_btn">
						<i class="fas fa-save"></i>
						Update Admit Card
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
		// Form submission
		$('#update_frm').on('submit', function(e) {
			$('#update_btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...');
		});
	});
</script>
@endpush
