@extends('admin.layouts.base')
@section('title', 'Edit Student')
@push('custom-css')
<style type="text/css">
	img.preview-img { max-width: 120px; max-height: 120px; display:block; margin-top:8px; }
</style>
@endpush
@section('content')
<div class="row mt-3">
	<div class="col-lg-12">
		<form id="update_frm" method="post" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="student_id" value="{{ $student->id ?? $student->sl_id ?? '' }}">

			<div class="card">
				<div class="card-header bg-secondary text-white font-weight-bold">
					Edit Student
					<span class='float-right' style='float:right'>
						<a href="{{ route('student_list') }}">  <button type="button" class="btn btn-dark btn-sm" > View All </button></a>
						<button type="submit" class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button>
					</span>
				</div>

				<div class="card-body">
					<div class='row'>
						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Select Center  <span class="text-danger">*</span></label>
								<select onchange="get_reg_no(this.value);" class="form-select select2" name='center_id' id='center_id' required>
									<option value=''> Select Center </option>
									@foreach($center as $data)
										<option value="{{ $data->cl_id }}"
											{{ (old('center_id', $student->sl_FK_of_center_id ?? '') == $data->cl_id) ? 'selected' : '' }}>
											{{ $data->cl_name }} [{{ $data->cl_code }}]
										</option>
									@endforeach
								</select>
							</div>

							<div class="form-group mb-3">
								<label>Select Course Name  <span class='badge bg-success' id='course_data' style='display:none'></span></label>
								<select onchange="get_course(this.value);" class="form-select select2" name='course_id' id='course_id' required>
									<option value=''> Select Course </option>
									@foreach($course as $data)
										<option value="{{ $data->c_id }}" {{ (old('course_id', $student->sl_FK_of_course_id ?? '') == $data->c_id) ? 'selected' : '' }}>
											{{ $data->c_short_name }} [{{ $data->c_duration }}]
										</option>
									@endforeach
								</select>
							</div>

							<div class="form-group mb-3">
								<label>Enter Student Name <span class="text-danger">*</span></label>
								<input class="form-control cp" placeholder="Student Name Here" name='student_name' value="{{ old('student_name', $student->sl_name ?? '') }}" required>
							</div>

							<div class="form-group mb-3">
								<label>Enter Mother's Name <span class="text-danger">*</span></label>
								<input class="form-control cp" placeholder="Mother's Name" name='student_mother' value="{{ old('student_mother', $student->sl_mother_name ?? '') }}" required>
							</div>

							<div class="form-group mb-3">
								<label>Enter Father's Name <span class="text-danger">*</span></label>
								<input class="form-control cp" placeholder="Father's Name" name='student_father' value="{{ old('student_father', $student->sl_father_name ?? '') }}" required>
							</div>

						</div>

						<div class="col-md-4 mb-3">
							<div class="form-group mb-3">
								<label>Date of Birth <span class="text-danger">*</span></label>
								<input class="form-control" type='date' name='date_of_birth' max='2015-01-01' value="{{ old('date_of_birth', $student->sl_dob ?? '') }}" required>
							</div>
							<div class="form-group mb-3">
								<label>Select Sex <span class="text-danger">*</span></label>
								<select class="form-select" name='student_sex' required>
									<option value='' ></option>
									<option value='MALE' {{ (old('student_sex', $student->sl_sex ?? '') == 'MALE') ? 'selected' : '' }}>MALE</option>
									<option value='FEMALE' {{ (old('student_sex', $student->sl_sex ?? '') == 'FEMALE') ? 'selected' : '' }}>FEMALE</option>
									<option value='OTHER' {{ (old('student_sex', $student->sl_sex ?? '') == 'OTHER') ? 'selected' : '' }}>OTHER</option>
								</select>
							</div>

							<div class="form-group mb-3">
								<label>Address <span class="text-danger">*</span></label>
								<textarea class="form-control cp" rows="3" name='student_address' required>{{ old('student_address', $student->sl_address ?? '') }}</textarea>
							</div>

							<div class="form-group mb-3">
								<label>Enter Mobile No. <span class="text-danger">*</span></label>
								<input class="form-control" type='number' minlength='10' name='student_mobile' maxlength='10' value="{{ old('student_mobile', $student->sl_mobile_no ?? '') }}" required>
							</div>
							<div class="form-group mb-3">
								<label>Enter Email Id. <span class="text-danger">*</span></label>
								<input class="form-control" placeholder="someone@email.com" name='student_email' type='email' value="{{ old('student_email', $student->sl_email ?? '') }}" >
							</div>

							<div class="form-group mb-3">
								<label>Registration No</label>
								<div><strong id="rollNo">{{ $student->sl_reg_no ?? '' }}</strong></div>
							</div>

						</div>

						<div class="col-md-4 ">
							<div class="form-group mb-3">
								<label>Select Qualification <span class="text-danger">*</span></label>
								<select class="form-select select2" name='student_qualification' required>
									<option value='' selected></option>
									@php $qual = old('student_qualification', $student->sl_qualification ?? ''); @endphp
									<option value='Non Matric' {{ $qual == 'Non Matric' ? 'selected' : '' }}>Non Matric</option>
									<option value='Matric' {{ $qual == 'Matric' ? 'selected' : '' }}>Matric</option>
									<option value='Intermediate' {{ $qual == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
									<option value='Graduate' {{ $qual == 'Graduate' ? 'selected' : '' }}>Graduate</option>
									<option value='Post Graduate' {{ $qual == 'Post Graduate' ? 'selected' : '' }}>Post Graduate</option>
								</select>
							</div>

							<div class="form-group mb-3">
								<label>Upload Photograph <span class="text-danger">*</span></label>
								<input class="form-control" type='file' name='student_photo' id='uploadimg' accept="image/*">
								@if(!empty($student->sl_photo))
									@if(str_contains($student->sl_photo, 'storage/'))
										@php $photoUrl = asset($student->sl_photo); @endphp
									@else
										@php $photoUrl = asset('storage/'.$student->sl_photo); @endphp
									@endif
									<a href="{{ $photoUrl }}" target="_blank">View current photo</a>
									<img src="{{ $photoUrl }}" class="preview-img" alt="photo">
									<div class="form-check mt-2">
										<input class="form-check-input" type="checkbox" name="remove_photo" id="remove_photo" value="1">
										<label class="form-check-label" for="remove_photo">Remove current photo</label>
									</div>
								@endif
							</div>

							<div class="form-group mb-3">
								<label>Upload Identity Card <span class="text-danger">*</span></label><br>
								<input class="form-control" type='file' name='student_id_card' id='upload_id_proof' accept='image/*,application/pdf'>
								@if(!empty($student->sl_id_card))
									@php $idUrl = (str_contains($student->sl_id_card, 'storage/')) ? asset($student->sl_id_card) : asset('storage/'.$student->sl_id_card); @endphp
									<a href="{{ $idUrl }}" target="_blank">View current ID</a>
									@if(str_contains($student->sl_id_card, '.jpg') || str_contains($student->sl_id_card, '.png') || str_contains($student->sl_id_card, '.jpeg'))
										<img src="{{ $idUrl }}" class="preview-img" alt="id card">
									@endif
									<div class="form-check mt-2">
										<input class="form-check-input" type="checkbox" name="remove_id_card" id="remove_id_card" value="1">
										<label class="form-check-label" for="remove_id_card">Remove current ID</label>
									</div>
								@endif
								<br><small> Scan copy of VIC, Aadhar, PAN, DL etc. </small>
							</div>

							<div class="form-group mb-3">
								<label>Upload Educational Certificate <span class="text-danger">*</span></label>
								<input class="form-control" type='file' name='student_educational_certificate' id='upload_edu_proof' accept='image/*,application/pdf'>
								@if(!empty($student->sl_educational_certificate))
									@php $eduUrl = (str_contains($student->sl_educational_certificate, 'storage/')) ? asset($student->sl_educational_certificate) : asset('storage/'.$student->sl_educational_certificate); @endphp
									<a href="{{ $eduUrl }}" target="_blank">View current certificate</a>
									@if(str_contains($student->sl_educational_certificate, '.jpg') || str_contains($student->sl_educational_certificate, '.png') || str_contains($student->sl_educational_certificate, '.jpeg'))
										<img src="{{ $eduUrl }}" class="preview-img" alt="certificate">
									@endif
									<div class="form-check mt-2">
										<input class="form-check-input" type="checkbox" name="remove_edu_certificate" id="remove_edu_certificate" value="1">
										<label class="form-check-label" for="remove_edu_certificate">Remove current certificate</label>
									</div>
								@endif
								<br><small> Marks Sheet, Certificate etc.</small>
							</div>
						</div>
					</div>
				</div>

				<!-- optionally card-footer for extra controls -->
			</div>
		</form>
	</div>
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
				} else {
					$('#course_data').hide();
				}
			}
		});
	}

	// Get Registration No (for center change)
	function get_reg_no(center_id){
	    $.ajax({
			url: "{{ route('get_reg_no') }}",
			type: "get",
			data: {center_id:center_id},
			dataType: "json",
			success: function(response){
				if(response.status == 1){
					$('#rollNo').text(response.reg_no);
				}else{
				    $('#rollNo').text(response.msg);
				}
			}
		});
	}

	// Optional: preview uploaded images client-side before submit
	function readURL(input, previewSelector) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$(previewSelector).attr('src', e.target.result).show();
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#uploadimg').change(function(){ readURL(this, '.preview-img'); });
	$('#upload_id_proof').change(function(){ readURL(this, '.preview-img'); });
	$('#upload_edu_proof').change(function(){ readURL(this, '.preview-img'); });

	// On page load, trigger course data render (if course id exists)
	$(document).ready(function(){
		let courseId = "{{ old('course_id', $student->sl_FK_of_course_id ?? '') }}";
		if(courseId) {
			get_course(courseId);
		}
	});
</script>
@endpush
