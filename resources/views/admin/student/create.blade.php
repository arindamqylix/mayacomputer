@extends('admin.layouts.base')
@section('title', 'Add Student')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
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
							<div class="form-group mb-3">
								<label>Select Center  <span class="text-danger">*</span></label>
								<select onchange="get_reg_no(this.value);" class="form-select select2" name='center_id' id='center_id'  required >
									<option value=''> Select Center </option>
									@foreach($center as $data)
										<option value="{{ $data->cl_id }}">{{ $data->cl_name }} [{{ $data->cl_code }}]</option>
									@endforeach
								</select>
								
							</div>
								<div class="form-group mb-3">
								<label>Select Course Name  <span class='badge bg-success' id='course_data' style='display:none'></span></label>
								<select onchange="get_course(this.value);" class="form-select select2" name='course_id' id='course_id'  required   >
									<option value=''> Select Course </option>
									@foreach($course as $data)
										<option value="{{ $data->c_id }}">{{ $data->c_short_name }} [{{ $data->c_duration }}]</option>
									@endforeach
								</select>
								
							</div>
							
							<div class="form-group mb-3">
								<label>Enter Student Name <span class="text-danger">*</span></label>
								<input class="form-control cp" placeholder="Student Name Here" name='student_name' value='' required>
							</div>
							<div class="form-group mb-3">
								<label>Enter Mother's Name <span class="text-danger">*</span></label>
								<input class="form-control cp" placeholder="Mother's Name" name='student_mother' value='' required>
							</div>
							<div class="form-group mb-3">
								<label>Enter Father's Name <span class="text-danger">*</span></label>
								<input class="form-control cp" placeholder="Father's Name" name='student_father' value='' required>
							</div>
							
							
						</div>
						<div class="col-md-4 mb-3">
							
							<div class="form-group mb-3">
								<label>Date of Birth <span class="text-danger">*</span></label>
								<input class="form-control"  type='date' name='date_of_birth' max='2015-01-01' value='' required>
							</div>
							<div class="form-group mb-3">
								<label>Select Sex <span class="text-danger">*</span></label>
								<select class="form-select" name='student_sex' required>
									<option value='' selected></option>
									<option value='MALE' >MALE</option>
									<option value='FEMALE' >FEMALE</option>
									<option value='OTHER' >OTHER</option>
								</select>
							</div>
							
							<div class="form-group mb-3">
								<label>Address <span class="text-danger">*</span></label>
								<textarea class="form-control cp" rows="3" name='student_address' required></textarea>
							</div>
							
							
							<div class="form-group mb-3">
								<label>Enter Mobile No. <span class="text-danger">*</span></label>
								<input class="form-control"  type='number' minlength='10' name='student_mobile' maxlength='10' value='' required>
							</div>
							<div class="form-group mb-3">
								<label>Enter Email Id. <span class="text-danger">*</span></label>
								<input class="form-control" placeholder="someone@email.com" name='student_email' type='email' value='' >
							</div>
							<input type='hidden' name='status' value='PENDING'>
						</div>
						<div class="col-md-4 ">
							<div class="form-group mb-3">
								<label>Select Qualification <span class="text-danger">*</span></label>
								<select class="form-select select2 " name='student_qualification' required>
									<option value='' selected></option>
									<option value='Non Matric' >Non Matric</option>
									<option value='Matric' >Matric</option>
									<option value='Intermediate' >Intermediate</option>
									<option value='Graduate' >Graduate</option>
									<option value='Post Graduate' >Post Graduate</option>
								</select>
							</div>
							<div class="form-group mb-3">
								<label>Upload Photograph <span class="text-danger">*</span></label>
								<input class="form-control" type='file' name='student_photo' id='uploadimg' accept='image' required>
							</div>
							
		
							<div class="form-group mb-3">
								<label>Upload Identity Card <span class="text-danger">*</span></label><br>
								<input class="form-control" type='file' name='student_id_card' id='upload_id_proof' accept='image' required>
								<br><small> Scan copy of VIC, Aadhar, PAN, DL etc. </small>
							</div>
		
					
							<div class="form-group mb-3">
								<label>Upload Educational Certificate <span class="text-danger">*</span></label>
								<input class="form-control" type='file' name='student_educational_certificate' id='upload_edu_proof' accept='image' required>
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
</script>
@endpush