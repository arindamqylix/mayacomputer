@extends('center.layouts.base')
@section('title', 'Profile Update')
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
					Profile Update
					<button class="btn btn-success btn-sm" id="update_btn" accesskey="s"> SAVE </button> 
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Center Code</label>
									</div>
									<div class="col-lg-6">
										<input readonly type="text" name="center_code" value="{{ $data->cl_code }}" class="form-control" required name="" placeholder="Center Code">
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Center Name</label>
									</div>
									<div class="col-lg-6">
										<input type="text" name="center_name" required value="{{ $data->cl_center_name }}" class="form-control" name="" placeholder="Center Name">
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Director Name</label>
									</div>
									<div class="col-lg-6">
										<input type="text" name="director_name" required value="{{ $data->cl_director_name }}" class="form-control" name="" placeholder="Director Name">
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Address</label>
									</div>
									<div class="col-lg-6">
										<textarea name="address" class="form-control" required placeholder="Address">{{ $data->cl_center_address }}</textarea>
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Email Id</label>
									</div>
									<div class="col-lg-6">
										<input type="email" required value="{{ $data->cl_email }}" class="form-control" name="email" placeholder="Email">
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Mobile</label>
									</div>
									<div class="col-lg-6">
										<input type="number" required value="{{ $data->cl_mobile }}" class="form-control" name="mobile" placeholder="Mobile">
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>CIN No</label>
									</div>
									<div class="col-lg-6">
										<input type="text" value="{{ $data->cl_cin_no }}" class="form-control" name="cin_no" placeholder="CIN No">
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Photo</label>
									</div>
									<div class="col-lg-6">
										<input type="file" class="form-control" name="center_photo" placeholder="Photo">
									</div>
									@if ($data->cl_photo)
										<div class="col-lg-3">
											<img style="    width: 80px;height: 86px;" src="{{ asset('storage/center_profile/').'/'.$data->cl_photo }}">
										</div>
									@endif
									
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Center Logo</label>
									</div>
									<div class="col-lg-6">
										<input type="file"  class="form-control" name="center_logo" placeholder="Mobile">
									</div>
									@if ($data->cl_logo)
										<div class="col-lg-3">
											<img style="    width: 80px;height: 86px;" src="{{ asset('storage/center_profile/').'/'.$data->cl_logo }}">
										</div>
									@endif
								</div>
								<div class="row mb-2">
									<div class="col-lg-6">
										<label>Upload Authorized Signature</label>
									</div>
									<div class="col-lg-6">
										<input type="file" class="form-control" name="center_authorized_signature" placeholder="Mobile">
									</div>
									@if ($data->cl_authorized_signature)
										<div class="col-lg-3">
											<img style="    width: 80px;height: 86px;" src="{{ asset('storage/center_profile/').'/'.$data->cl_authorized_signature }}">
										</div>
									@endif
								</div>
						</div>
						<div class="col-lg-2"></div>
					</div>
				</div>
				<!-- end select2 -->
			</div>
			<!-- <div class="card-footer bg-white">
					<hr>
					
					<hr>
			</div> -->
		</form>
		</div>
		<!-- end row -->
		</div> <!-- container-fluid -->
	</div>
	<!-- End Page-content -->
</div>
@endsection
@push('custom-js')
<script type="text/javascript">
	
</script>
@endpush