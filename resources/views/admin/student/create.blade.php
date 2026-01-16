@extends('admin.layouts.base')
@section('title', 'Add Student')
@push('custom-css')
<style type="text/css">
    .form-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        border-left: 4px solid #667eea;
    }
    .form-section-title {
        font-size: 16px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .form-section-title i {
        margin-right: 10px;
        color: #667eea;
        font-size: 20px;
    }
    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
        font-size: 14px;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    .input-icon-wrapper {
        position: relative;
    }
    .input-icon-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        z-index: 10;
    }
    .input-icon-wrapper .form-control,
    .input-icon-wrapper .form-select {
        padding-left: 45px;
    }
    .file-upload-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    .file-upload-label {
        display: block;
        padding: 12px 20px;
        background: #f7fafc;
        border: 2px dashed #cbd5e0;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .file-upload-label:hover {
        background: #edf2f7;
        border-color: #667eea;
    }
    .file-upload-label i {
        font-size: 24px;
        color: #667eea;
        display: block;
        margin-bottom: 8px;
    }
    .file-upload-input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .file-preview {
        margin-top: 15px;
        text-align: center;
    }
    .file-preview img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .card-header-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 20px 25px;
    }
    .btn-action {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .required-star {
        color: #e53e3e;
        margin-left: 3px;
    }
    .help-text {
        font-size: 12px;
        color: #718096;
        margin-top: 5px;
    }
</style>
@endpush
@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row">
        <div class="col-12">
            <form id='update_frm' method="post" action="{{ route('add_new_student') }}" enctype="multipart/form-data">
			@csrf
                <div class="card border-0 shadow-sm">
                    <div class="card-header card-header-gradient d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 fw-bold">
                                <i class="fas fa-user-plus me-2"></i>Student Registration
                            </h4>
                            <p class="mb-0 opacity-75" style="font-size: 14px;">Fill in all the required information to register a new student</p>
                        </div>
                        <div>
                            <a href="{{ route('student_list') }}" class="btn btn-light btn-sm btn-action me-2">
                                <i class="fas fa-list me-1"></i> View All
                            </a>
                            <button type="submit" class="btn btn-success btn-sm btn-action" id="update_btn">
                                <i class="fas fa-save me-1"></i> SAVE
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-info-circle"></i> Basic Information
				</div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Select Center <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-building"></i>
                                        <select onchange="get_reg_no(this.value);" class="form-select" name='center_id' id='center_id' required>
									<option value=''> Select Center </option>
									@foreach($center as $data)
										<option value="{{ $data->cl_id }}">{{ $data->cl_name }} [{{ $data->cl_code }}]</option>
									@endforeach
								</select>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Select Course Name <span class='badge bg-success ms-2' id='course_data' style='display:none'></span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-graduation-cap"></i>
                                        <select onchange="get_course(this.value);" class="form-select " name='course_id' id='course_id' required>
									<option value=''> Select Course </option>
									@foreach($course as $data)
										<option value="{{ $data->c_id }}">{{ $data->c_short_name }} [{{ $data->c_duration }}]</option>
									@endforeach
								</select>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Enter Student Name <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input class="form-control" placeholder="Student Name Here" name='student_name' value='' required>
                                    </div>
                                </div>
                            </div>
							</div>
							
                        <!-- Personal Details Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-user-friends"></i> Personal Details
							</div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Enter Mother's Name <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-female"></i>
                                        <input class="form-control" placeholder="Mother's Name" name='student_mother' value='' required>
							</div>
							</div>
							
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Enter Father's Name <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-male"></i>
                                        <input class="form-control" placeholder="Father's Name" name='student_father' value='' required>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Date of Birth <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-calendar-alt"></i>
                                        <input class="form-control" type='date' name='date_of_birth' max='2015-01-01' value='' required>
                                    </div>
						</div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Select Sex <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-venus-mars"></i>
								<select class="form-select" name='student_sex' required>
                                            <option value='' selected>Select Gender</option>
                                            <option value='MALE'>MALE</option>
                                            <option value='FEMALE'>FEMALE</option>
                                            <option value='OTHER'>OTHER</option>
								</select>
							</div>
							</div>
							
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Select Qualification <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-certificate"></i>
                                        <select class="form-select " name='student_qualification' required>
                                            <option value='' selected>Select Qualification</option>
                                            <option value='Non Matric'>Non Matric</option>
                                            <option value='Matric'>Matric</option>
                                            <option value='Intermediate'>Intermediate</option>
                                            <option value='Graduate'>Graduate</option>
                                            <option value='Post Graduate'>Post Graduate</option>
								</select>
							</div>
							</div>
							
                                <div class="col-md-12 mb-4">
                                    <label class="form-label">Address <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-map-marker-alt" style="top: 20px;"></i>
                                        <textarea class="form-control" rows="3" name='student_address' placeholder="Enter full address" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-address-book"></i> Contact Information
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Enter Mobile No. <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-phone"></i>
                                        <input class="form-control" type='tel' pattern='[0-9]{10}' name='student_mobile' maxlength='10' placeholder="10 digit mobile number" required>
                                    </div>
                                    <div class="help-text">Please enter a 10-digit mobile number</div>
							</div>
		
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Enter Email Id. <span class="required-star">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-envelope"></i>
                                        <input class="form-control" placeholder="someone@email.com" name='student_email' type='email' value=''>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-file-upload"></i> Documents & Certificates
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Upload Photograph <span class="required-star">*</span></label>
                                    <div class="file-upload-wrapper">
                                        <label class="file-upload-label" for="uploadimg">
                                            <i class="fas fa-camera"></i>
                                            <span>Click to upload photo</span>
                                            <small class="d-block mt-2 text-muted">JPG, PNG (Max 2MB)</small>
                                        </label>
                                        <input class="file-upload-input" type='file' name='student_photo' id='uploadimg' accept='image/*' required>
                                        <div class="file-preview" id="photo-preview"></div>
                                    </div>
							</div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Upload Identity Card <span class="required-star">*</span></label>
                                    <div class="file-upload-wrapper">
                                        <label class="file-upload-label" for="upload_id_proof">
                                            <i class="fas fa-id-card"></i>
                                            <span>Click to upload ID</span>
                                            <small class="d-block mt-2 text-muted">Aadhar, PAN, DL, VIC etc.</small>
                                        </label>
                                        <input class="file-upload-input" type='file' name='student_id_card' id='upload_id_proof' accept='image/*,application/pdf' required>
                                        <div class="file-preview" id="idcard-preview"></div>
                                    </div>
                                    <div class="help-text">Scan copy of VIC, Aadhar, PAN, DL etc.</div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Upload Educational Certificate <span class="required-star">*</span></label>
                                    <div class="file-upload-wrapper">
                                        <label class="file-upload-label" for="upload_edu_proof">
                                            <i class="fas fa-file-certificate"></i>
                                            <span>Click to upload certificate</span>
                                            <small class="d-block mt-2 text-muted">Marks Sheet, Certificate etc.</small>
                                        </label>
                                        <input class="file-upload-input" type='file' name='student_educational_certificate' id='upload_edu_proof' accept='image/*,application/pdf' required>
                                        <div class="file-preview" id="edu-preview"></div>
                                    </div>
                                    <div class="help-text">Marks Sheet, Certificate etc.</div>
                                </div>
                            </div>
                        </div>

                        <input type='hidden' name='status' value='PENDING'>
                    </div>

                    <div class="card-footer bg-light border-top d-flex justify-content-end gap-2 py-3">
                        <a href="{{ route('student_list') }}" class="btn btn-secondary btn-action">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-success btn-action" id="update_btn">
                            <i class="fas fa-save me-1"></i> Save Student
                        </button>
					</div>
				</div>
            </form>
		</div>
	</div>
</div>
@endsection

@push('custom-js')
<script type="text/javascript">
    $('.select2').select2({
        theme: 'bootstrap-5'
    });

    // File upload preview
    function setupFilePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const label = input.closest('.file-upload-wrapper').querySelector('.file-upload-label');

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid">`;
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.innerHTML = `<div class="alert alert-info"><i class="fas fa-file-pdf"></i> ${file.name}</div>`;
                }
                label.querySelector('span').textContent = 'File selected: ' + file.name;
            }
        });
    }

    setupFilePreview('uploadimg', 'photo-preview');
    setupFilePreview('upload_id_proof', 'idcard-preview');
    setupFilePreview('upload_edu_proof', 'edu-preview');

	// Get Course
	function get_course(course_id){
		$.ajax({
			url: "{{ route('get_course') }}",
			type: "get",
			data: {course_id:course_id},
			dataType: "json",
			success: function(response){
				if(response.status == 1){
					$('#course_data').show();
					$('#course_data').text(response.msg + ' | Price: ' + response.price);
                } else {
                    $('#course_data').hide();
				}
			}
		});
	}
	
    // Get Registration No
	function get_reg_no(center_id){
	    $.ajax({
			url: "{{ route('get_reg_no') }}",
			type: "get",
			data: {center_id:center_id},
			dataType: "json",
			success: function(response){
				if(response.status == 1){
                    // Registration number will be generated on server side
				}
			}
		});
	}
</script>
@endpush
