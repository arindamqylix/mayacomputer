@extends('center.layouts.base')
@section('title', 'Add Student')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<!-- start page title -->

<!-- end page title -->
<div class="row mt-3">
	<div class="col-lg-12">
		<form id="update_frm" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-header bg-secondary text-white font-weight-bold">
            Student Registration

            <span class="float-right">
                <a href="{{ route('student_list') }}">
                    <button type="button" class="btn btn-dark btn-sm">View All</button>
                </a>

                <button class="btn btn-success btn-sm" id="update_btn" accesskey="s">SAVE</button>
            </span>
        </div>

        <div class="card-body">
            <div class="row">

                <!-- ================= LEFT COLUMN ================= -->
                <div class="col-md-4 mb-3">

                    <input type="hidden" name="center_id" value="{{ $data->center_id ?? 5 }}">

                    <!-- Course -->
                    <div class="form-group mb-3">
                        <label>Select Course Name <sup class="text-danger">*</sup></label>
                        <select onchange="get_course(this.value);" class="form-select" 
                            name="course_id" id="course_id" required>
                            <option value="">--Select Course--</option>

                            @foreach($course as $item)
                                <option value="{{ $item->c_id }}"
                                    {{ $data->sl_FK_of_course_id == $item->c_id ? 'selected' : '' }}>
                                    {{ $item->c_short_name }} [{{ $item->c_duration }}]
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Roll -->
                    <div class="form-group mb-3">
                        <label>
                            Reg. No.
                            <span class='badge bg-success'>
                                {{ $data->sl_reg_no ?? '' }}
                            </span>
                            <sup class="text-danger">*</sup>
                        </label>

                        <input class="form-control"
                               type="number"
                               id="student_roll"
                               name="student_roll"
                               value="{{ $data->sl_reg_no }}"
                               minlength="4"
                               maxlength="4"
                               placeholder="Valid 4 Digit"
                               required>
                    </div>

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label>Enter Student Name <sup class="text-danger">*</sup></label>
                        <input class="form-control cp" 
                               name="student_name"
                               value="{{ $data->sl_name }}"
                               required>
                    </div>

                    <!-- Mother -->
                    <div class="form-group mb-3">
                        <label>Enter Mother's Name <sup class="text-danger">*</sup></label>
                        <input class="form-control cp" 
                               name="student_mother"
                               value="{{ $data->sl_mother_name }}"
                               required>
                    </div>

                    <!-- Father -->
                    <div class="form-group mb-3">
                        <label>Enter Father's Name <sup class="text-danger">*</sup></label>
                        <input class="form-control cp" 
                               name="student_father"
                               value="{{ $data->sl_father_name }}"
                               required>
                    </div>

                </div>

                <!-- ================= MIDDLE COLUMN ================= -->
                <div class="col-md-4 mb-3">

                    <!-- DOB -->
                    <div class="form-group mb-3">
                        <label>Date of Birth <sup class="text-danger">*</sup></label>
                        <input class="form-control" 
                               type="date" 
                               name="date_of_birth"
                               value="{{ $data->sl_dob }}"
                               max="2015-01-01"
                               required>
                    </div>

                    <!-- Gender -->
                    <div class="form-group mb-3">
                        <label>Select Sex <sup class="text-danger">*</sup></label>
                        <select class="form-control" name="student_sex" required>
                            <option value="">--Choose Gender--</option>
                            <option value="MALE" {{ $data->sl_sex == 'MALE' ? 'selected' : '' }}>MALE</option>
                            <option value="FEMALE" {{ $data->sl_sex == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                            <option value="OTHER" {{ $data->sl_sex == 'OTHER' ? 'selected' : '' }}>OTHER</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="form-group mb-3">
                        <label>Address <sup class="text-danger">*</sup></label>
                        <textarea class="form-control cp" rows="3" required
                                  name="student_address">{{ $data->sl_address }}</textarea>
                    </div>

                    <!-- Mobile -->
                    <div class="form-group mb-3">
                        <label>Enter Mobile No. <sup class="text-danger">*</sup></label>
                        <input class="form-control" 
                               type="number"
                               minlength="10"
                               maxlength="10"
                               name="student_mobile"
                               value="{{ $data->sl_mobile_no }}"
                               required>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label>Enter Email Id <sup class="text-danger">*</sup></label>
                        <input class="form-control"
                               type="email"
                               name="student_email"
                               value="{{ $data->sl_email }}"
                               required>
                    </div>

                    <input type="hidden" name="status" value="{{ $data->sl_status ?? 'PENDING' }}">

                </div>

                <!-- ================= RIGHT COLUMN ================= -->
                <div class="col-md-4">

                    <!-- Qualification -->
                    <div class="form-group mb-3">
                        <label>Select Qualification <sup class="text-danger">*</sup></label>
                        <select class="form-control" name="student_qualification" required>
                            <option value="">--Choose Qualification--</option>
                            <option value="Non Matric"     {{ $data->sl_qualification == 'Non Matric' ? 'selected' : '' }}>Non Matric</option>
                            <option value="Matric"         {{ $data->sl_qualification == 'Matric' ? 'selected' : '' }}>Matric</option>
                            <option value="Intermediate"   {{ $data->sl_qualification == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Graduate"       {{ $data->sl_qualification == 'Graduate' ? 'selected' : '' }}>Graduate</option>
                            <option value="Post Graduate"  {{ $data->sl_qualification == 'Post Graduate' ? 'selected' : '' }}>Post Graduate</option>
                        </select>
                    </div>

                    <!-- Photo -->
                    <div class="form-group mb-3">
                        <label>Upload Photograph</label><br>

                        @if(!empty($data->sl_photo))
                            <img src="{{ asset('storage/student/'.$data->sl_photo) }}" 
                                 width="100" class="mb-2">
                        @endif

                        <input class="form-control" type="file" name="student_photo" accept="image/*">
                    </div>

                    <!-- ID Card -->
                    <div class="form-group mb-3">
                        <label>Upload Identity Card</label><br>

                        @if(!empty($data->sl_id_card))
                                 <img src="{{ asset('storage/student/'.$data->sl_id_card) }}" 
                                 width="100" class="mb-2">
                        @endif

                        <input class="form-control" type="file" name="student_id_card" accept="image/*">
                        <small>Scan copy of Voter ID, Aadhaar, PAN, DL etc.</small>
                    </div>

                    <!-- Educational Certificate -->
                    <div class="form-group mb-3">
                        <label>Upload Educational Certificate</label><br>

                        @if(!empty($data->sl_educational_certificate))
                            <img src="{{ asset('storage/student/'.$data->sl_educational_certificate) }}" 
                                 width="100" class="mb-2">
                        @endif

                        <input class="form-control" type="file" name="student_educational_certificate" accept="image/*">
                        <small>Marksheet, Certificate etc.</small>
                    </div>

                </div>

            </div>
        </div>
    </div>

</form>

	</div>
	<!-- End Page-content -->
</div>
@endsection
@push('custom-js')
<script type="text/javascript">
	$('.select2').select2();
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
					$('#course_data').text(response.msg);
				}
			}
		});
	}
</script>
@endpush