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
		<form id='update_frm' method="post" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header bg-secondary text-white font-weight-bold">
					Student Registration
					<span class='float-right' style='float:right'>
						<a href="{{ route('student_list') }}">  <button class="btn btn-dark btn-sm" > View All </button></a>
					<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button></span>
				</div>
				<div class="card-body"> 
					<div class='row'>
						<div class="col-md-4 mb-3">
							<!--<input type='hidden' name='status' value='PENDING'>-->
							<input type='hidden' value ='5' name='center_id'>
							<div class="form-group mb-3">
								<label>Select Course Name <sup class="text-danger">*</sup>  <span class='badge bg-success' id='course_data' style='display:none'> </span></label>
								<select onchange="get_course(this.value);" class="form-select" name='course_id' id='course_id'  required   >
									<option value=''>--Select Course--</option>
									@foreach($course as $data)
										<option value="{{ $data->c_id }}">{{ $data->c_short_name }} [{{ $data->c_duration }}]</option>
									@endforeach
								</select>
								
							</div>
							<div class="form-group mb-3">
								<label>Enter Student Name <sup class="text-danger">*</sup></label>
								<input class="form-control cp" placeholder="Student Name Here" name='student_name' value='' required>
							</div>
							<div class="form-group mb-3">
								<label>Enter Mother's Name <sup class="text-danger">*</sup></label>
								<input class="form-control cp" placeholder="Mother's Name" name='student_mother' value='' required>
							</div>
							<div class="form-group mb-3">
								<label>Enter Father's Name <sup class="text-danger">*</sup></label>
								<input class="form-control cp" placeholder="Father's Name" name='student_father' value='' required>
							</div>
							
							
						</div>
						<div class="col-md-4 mb-3">
							
							<div class="form-group mb-3">
								<label>Date of Birth <sup class="text-danger">*</sup></label>
								<input class="form-control"  type='date' name='date_of_birth' max='2015-01-01' value='' required>
							</div>
							<div class="form-group mb-3">
								<label>Select Sex <sup class="text-danger">*</sup></label>
								<select class="form-control" name='student_sex' required>
									<option value='' selected>--Choose Gender--</option>
									<option value='MALE' >MALE</option>
									<option value='FEMALE' >FEMALE</option>
									<option value='OTHER' >OTHER</option>
								</select>
							</div>
							
							<div class="form-group mb-3">
								<label>Address <sup class="text-danger">*</sup></label>
								<textarea class="form-control cp" rows="3" name='student_address' required></textarea>
							</div>
							
							
							<div class="form-group mb-3">
								<label>Enter Mobile No. <sup class="text-danger">*</sup> </label>
								<input class="form-control"  type='number' minlength='10' name='student_mobile' maxlength='10' value='' required>
							</div>
							<div class="form-group mb-3">
								<label>Enter Email Id.<sup class="text-danger">*</sup></label>
								<input class="form-control" placeholder="someone@email.com" name='student_email' type='email' value='' required>
							</div>
							<input type='hidden' name='status' value='PENDING'>
						</div>
						<div class="col-md-4 ">
							<div class="form-group mb-3">
								<label>Select Qualification <sup class="text-danger">*</sup></label>
								<select class="form-control " name='student_qualification' required>
									<option value='' selected>--Choose Qualification--</option>
									<option value='Non Matric' >Non Matric</option>
									<option value='Matric' >Matric</option>
									<option value='Intermediate' >Intermediate</option>
									<option value='Graduate' >Graduate</option>
									<option value='Post Graduate' >Post Graduate</option>
								</select>
							</div>
							<div class="form-group mb-3">
								<label>Upload Photograph</label>
								<input class="form-control" type='file' name='student_photo' id='uploadimg' accept='image'>
							</div>
							
		
							<div class="form-group mb-3">
								<label>Upload Identity Card </label><br>
								<input class="form-control" type='file' name='student_id_card' id='upload_id_proof' accept='image'>
								<br><small> Scan copy of VIC, Aadhar, PAN, DL etc. </small>
							</div>
		
					
							<div class="form-group mb-3">
								<label>Upload Educational Certificate</label>
								<input class="form-control" type='file' name='student_educational_certificate' id='upload_edu_proof' accept='image'>
								<br><small> Marks Sheet, Certificate etc.</small>
							</div>
						</form>
							

						
						
					</div>
				</div>
				<!-- end select2 -->
			</div>
			<!-- <div class="card-footer bg-white">
					<hr>
					
					<hr>
			</div> -->
		</div>
		<!-- end row -->
		</div> <!-- container-fluid -->
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