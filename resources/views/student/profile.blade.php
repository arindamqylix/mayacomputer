@extends('backend.layouts.base')
@section('title', 'Profile')
@push('custom-css')
	<style type="text/css">
		.form-section-heading {
			background: linear-gradient(to right, #4e73df, #825ee4);
			padding: 12px;
			height: 44px;
		}
		.form-section-heading h5{
			color: #fff;
		}
		.card-body input{
			border-radius: 15px;
    		padding: 8px;
		}
	</style>
@endpush
@section('content')
<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Profile</h4>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header form-section-heading">
				<h5>Profile Update</h5>
			</div>
			<div class="card-body">
				<form method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-lg-12 mb-2">
							<div class="form-group">
								<label>Fullname</label>
								<input type="text" class="form-control" value="{{ $data->al_name }}" name="fullname" placeholder="Enter Your Fullname">
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" value="{{ $data->al_email }}" name="email" placeholder="Enter Your Email">
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="form-group">
								<label>Mobile</label>
							</div>
							<input type="number" class="form-control" value="{{ $data->al_mobile }}" name="mobile" placeholder="Enter Your Mobile">
						</div>
						<div class="col-lg-12 mb-2">
							<div id="imageContainer">
								@if($data->al_photo)
									<img id="selectedImage" src="{{ asset('admin/profile/').'/'.$data->al_photo }}" alt="Selected Image">
								@else
							    	<img id="selectedImage" src="{{ asset('no_img.png') }}" alt="Selected Image">
								@endif
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="form-group">
								<label>Photo</label>
							</div>
							<input type="file" id="imageInput" class="form-control" name="photo">
						</div>
						<div class="col-lg-3 "></div>
						<div class="col-lg-6 ">
							<button type="submit" class="btn w-100 btn-secondary custom-button btn-lg"> <i class="fa fa-save"></i> Save</button>
						</div>
						<div class="col-lg-3"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('custom-js')

@endpush