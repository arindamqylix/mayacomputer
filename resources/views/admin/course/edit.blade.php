@extends('admin.layouts.base')
@section('title', 'Edit Course')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<!-- start page title -->
<div class="row mt-3">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between">
			<h4 class="mb-sm-0 font-size-18">Course</h4>
		</div>
	</div>
</div>
<!-- end page title -->
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header form-section-heading">
				<h5>Course Form</h5>
			</div>
			<div class="card-body">
				<form method="POST" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-lg-12 mb-2">
							<div class="form-group">
								<label>Course Short Name</label>
								<input type="text" class="form-control"  name="course_short_name" value="{{ $data->c_short_name }}" placeholder="Course Short Name">
								@error('course_short_name')
								<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="form-group">
								<label>Course Full Name</label>
								<input type="text" class="form-control"  name="course_full_name" value="{{ $data->c_full_name }}" placeholder="Course Full Name">
								@error('course_full_name')
								<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="form-group">
								<label>Course Price</label>
								<input type="text" class="form-control"  name="course_price" value="{{ $data->c_price }}" placeholder="Course Price">
								@error('course_price')
								<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="col-lg-12 mb-2">
							<div class="form-group">
								<label>Course Duration</label>
								<input type="text" class="form-control"  name="course_duration" value="{{ $data->c_duration }}" placeholder="Course Duration">
								@error('course_duration')
								<p class="text-danger">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="col-lg-3"></div>
						<div class="col-lg-6">
							<button type="submit" class="btn w-100 btn-secondary custom-button "> <i class="fa fa-save"></i> Save</button>
						</div>
						<div class="col-lg-3 "></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('custom-js')
@endpush