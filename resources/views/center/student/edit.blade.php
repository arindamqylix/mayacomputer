@extends('center.layouts.base')
@section('title', 'Edit Student')
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
	
	.btn-save {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 0.75rem 2rem;
		border-radius: 0.5rem;
		font-weight: 600;
		box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
		transition: all 0.3s ease;
		color: white;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
	}
	
	.btn-save:hover {
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
	
	/* File Upload Styling */
	.file-upload-area {
		border: 2px dashed #dee2e6;
		border-radius: 0.5rem;
		padding: 1rem;
		text-align: center;
		transition: all 0.3s ease;
		background: #f8f9fa;
	}
	
	.file-upload-area:hover {
		border-color: #2563eb;
		background: #f0f4ff;
	}
	
	.file-preview {
		margin-top: 1rem;
		text-align: center;
	}
	
	.file-preview img {
		max-width: 150px;
		max-height: 150px;
		border-radius: 0.5rem;
		border: 2px solid #dee2e6;
		box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	}
	
	/* Existing Image Preview */
	.existing-image {
		margin-bottom: 1rem;
		text-align: center;
	}
	
	.existing-image img {
		max-width: 150px;
		max-height: 150px;
		border-radius: 0.5rem;
		border: 2px solid #2563eb;
		box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
	}
</style>
@endpush

@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<form id="update_frm" method="POST" action="{{ route('edit.student', $data->sl_id) }}" enctype="multipart/form-data">
			@csrf
			<div class="card modern-card">
				<div class="card-header form-header">
					<div class="d-flex justify-content-between align-items-center">
						<h4>
							<i class="fas fa-edit"></i>
							Edit Student Registration
						</h4>
						<div>
							<a href="{{ route('pending_student') }}" class="btn-view-all">
								<i class="fas fa-list"></i>
								View All
							</a>
							<button type="submit" class="btn-save" id="update_btn">
								<i class="fas fa-save"></i>
								UPDATE
							</button>
						</div>
					</div>
				</div>
				<div class="card-body p-4">
					<div class="row">
						<div class="col-md-4 mb-3">
							<input type="hidden" name="center_id" value="{{ $data->sl_FK_of_center_id ?? Auth::guard('center')->user()->cl_id }}">
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-graduation-cap"></i>
									Select Course Name <span class="text-danger">*</span>
								</label>
								<select onchange="get_course(this.value);" class="form-select" name="course_id" id="course_id" required>
									<option value="">--Select Course--</option>
									@foreach($course as $item)
										<option value="{{ $item->c_id }}" {{ $data->sl_FK_of_course_id == $item->c_id ? 'selected' : '' }}>
											{{ $item->c_short_name }} [{{ $item->c_duration }}]
										</option>
									@endforeach
								</select>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-hashtag"></i>
									Reg. No.
									<span class='badge bg-success ms-2'>{{ $data->sl_reg_no ?? '' }}</span>
								</label>
								<input class="form-control" type="number" id="student_roll" name="student_roll" value="{{ $data->sl_reg_no }}" minlength="4" maxlength="4" placeholder="Valid 4 Digit" required>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-user"></i>
									Enter Student Name <span class="text-danger">*</span>
								</label>
								<input class="form-control" name="student_name" value="{{ $data->sl_name }}" required>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-female"></i>
									Enter Mother's Name <span class="text-danger">*</span>
								</label>
								<input class="form-control" name="student_mother" value="{{ $data->sl_mother_name }}" required>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-male"></i>
									Enter Father's Name <span class="text-danger">*</span>
								</label>
								<input class="form-control" name="student_father" value="{{ $data->sl_father_name }}" required>
							</div>
						</div>
						
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-calendar-alt"></i>
									Date of Birth <span class="text-danger">*</span>
								</label>
								<input class="form-control" type="date" name="date_of_birth" value="{{ $data->sl_dob }}" max="2015-01-01" required>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-venus-mars"></i>
									Select Sex <span class="text-danger">*</span>
								</label>
								<select class="form-select" name="student_sex" required>
									<option value="">--Choose Gender--</option>
									<option value="MALE" {{ $data->sl_sex == 'MALE' ? 'selected' : '' }}>MALE</option>
									<option value="FEMALE" {{ $data->sl_sex == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
									<option value="OTHER" {{ $data->sl_sex == 'OTHER' ? 'selected' : '' }}>OTHER</option>
								</select>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-map-marker-alt"></i>
									Address <span class="text-danger">*</span>
								</label>
								<textarea class="form-control" rows="3" name="student_address" required>{{ $data->sl_address }}</textarea>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-phone"></i>
									Enter Mobile No. <span class="text-danger">*</span>
								</label>
								<input class="form-control" type="number" minlength="10" maxlength="10" name="student_mobile" value="{{ $data->sl_mobile_no }}" required>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-envelope"></i>
									Enter Email Id <span class="text-danger">*</span>
								</label>
								<input class="form-control" type="email" name="student_email" value="{{ $data->sl_email }}" required>
							</div>
							
							<input type="hidden" name="status" value="{{ $data->sl_status ?? 'PENDING' }}">
						</div>
						
						<div class="col-md-4">
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-certificate"></i>
									Select Qualification <span class="text-danger">*</span>
								</label>
								<select class="form-select" name="student_qualification" required>
									<option value="">--Choose Qualification--</option>
									<option value="Non Matric" {{ $data->sl_qualification == 'Non Matric' ? 'selected' : '' }}>Non Matric</option>
									<option value="Matric" {{ $data->sl_qualification == 'Matric' ? 'selected' : '' }}>Matric</option>
									<option value="Intermediate" {{ $data->sl_qualification == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
									<option value="Graduate" {{ $data->sl_qualification == 'Graduate' ? 'selected' : '' }}>Graduate</option>
									<option value="Post Graduate" {{ $data->sl_qualification == 'Post Graduate' ? 'selected' : '' }}>Post Graduate</option>
								</select>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-image"></i>
									Upload Photograph
								</label>
								<div class="file-upload-area">
									@if(!empty($data->sl_photo))
										<div class="existing-image">
											<p class="small text-muted mb-2">Current Photo:</p>
											<img src="{{ asset('storage/student/'.$data->sl_photo) }}" alt="Current Photo">
										</div>
									@endif
									<input class="form-control" type="file" name="student_photo" accept="image/*" onchange="previewImage(this, 'photoPreview')">
									<div class="file-preview" id="photoPreview"></div>
								</div>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-id-card"></i>
									Upload Identity Card
								</label>
								<div class="file-upload-area">
									@if(!empty($data->sl_id_card))
										<div class="existing-image">
											<p class="small text-muted mb-2">Current ID Card:</p>
											<img src="{{ asset('storage/student/'.$data->sl_id_card) }}" alt="Current ID Card">
										</div>
									@endif
									<input class="form-control" type="file" name="student_id_card" accept="image/*" onchange="previewImage(this, 'idCardPreview')">
									<small class="text-muted d-block mt-2">
										<i class="fas fa-info-circle me-1"></i>
										Scan copy of VIC, Aadhar, PAN, DL etc.
									</small>
									<div class="file-preview" id="idCardPreview"></div>
								</div>
							</div>
							
							<div class="form-group mb-3">
								<label>
									<i class="fas fa-file-certificate"></i>
									Upload Educational Certificate
								</label>
								<div class="file-upload-area">
									@if(!empty($data->sl_educational_certificate))
										<div class="existing-image">
											<p class="small text-muted mb-2">Current Certificate:</p>
											<img src="{{ asset('storage/student/'.$data->sl_educational_certificate) }}" alt="Current Certificate">
										</div>
									@endif
									<input class="form-control" type="file" name="student_educational_certificate" accept="image/*" onchange="previewImage(this, 'eduCertPreview')">
									<small class="text-muted d-block mt-2">
										<i class="fas fa-info-circle me-1"></i>
										Marks Sheet, Certificate etc.
									</small>
									<div class="file-preview" id="eduCertPreview"></div>
								</div>
							</div>

							<div class="form-group mb-3">
								<label>
									<i class="fas fa-pen-nib"></i>
									Upload Signature
								</label>
								<div class="file-upload-area">
									@if(!empty($data->sl_signature))
										<div class="existing-image">
											<p class="small text-muted mb-2">Current Signature:</p>
											<img src="{{ asset('storage/student/'.$data->sl_signature) }}" alt="Current Signature">
										</div>
									@endif
									<input class="form-control" type="file" name="student_signature" accept="image/*" onchange="previewImage(this, 'signaturePreview')">
									<small class="text-muted d-block mt-2">
										<i class="fas fa-info-circle me-1"></i>
										Student Signature
									</small>
									<div class="file-preview" id="signaturePreview"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@push('custom-js')
<script type="text/javascript">
	// Image Preview Function
	function previewImage(input, previewId) {
		const preview = document.getElementById(previewId);
		if (input.files && input.files[0]) {
			const reader = new FileReader();
			reader.onload = function(e) {
				preview.innerHTML = '<p class="small text-success mb-2">New Preview:</p><img src="' + e.target.result + '" alt="Preview" class="img-fluid">';
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	// Get Course
	function get_course(course_id){
		$.ajax({
			url: "{{ route('get_course') }}",
			type: "get",
			data: {course_id:course_id},
			dataType: "json",
			success: function(response){
				if(response.status == 1){
					// Course info display if needed
				}
			}
		});
	}
	
	// Form submission
	$('#update_frm').on('submit', function(e) {
		$('#update_btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...');
	});
</script>
@endpush
