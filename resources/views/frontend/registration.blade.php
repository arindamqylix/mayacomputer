@extends('frontend.layouts.master')
@section('title','Registration Verification')
@section('content')
@php
	$data = DB::table('site_settings')->where('id','1')->first();
@endphp
<!-- Breadcrumbs Start -->
		<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
		    <div class="breadcrumbs-inner">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-12 text-center">
		                    <h1 class="page-title">Registration Verification</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
		                        <li>Registration Verification</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div><!-- .breadcrumbs-inner end -->
		</div>
		
		<!-- Breadcrumbs End -->

		<!-- Registration Verification Section Start -->
		<div class="verification-section sec-spacer">
			<div class="container">
				<div class="verification-form-wrapper" style="background: #f5f5f5; padding: 40px; border-radius: 10px; margin: 30px 0;">
					<form action="{{ route('verification.registration') }}" method="GET" id="registrationVerifyForm">
						<div class="row align-items-end justify-content-center">
							<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
								<label for="registration_no" style="font-weight: 600; color: #333; margin-bottom: 8px; display: block;">Enter Registration No</label>
								<input type="text" name="registration_no" id="registration_no" class="form-control" placeholder="Enter Registration No" value="{{ request('registration_no') }}" style="height: 50px; border-radius: 8px; border: 1px solid #ddd; padding: 10px 15px; font-size: 15px;">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 mb-3">
								<label for="dob" style="font-weight: 600; color: #333; margin-bottom: 8px; display: block;">Enter Date Of Birth</label>
								<input type="date" name="dob" id="dob" class="form-control" value="{{ request('dob') }}" style="height: 50px; border-radius: 8px; border: 1px solid #ddd; padding: 10px 15px; font-size: 15px;">
							</div>
							<div class="col-lg-2 col-md-3 col-sm-12 mb-3">
								<button type="submit" class="btn btn-primary" style="height: 50px; width: 100%; border-radius: 8px; background: #0d8aee; border: none; font-size: 16px; font-weight: 600; cursor: pointer;">Verify</button>
							</div>
						</div>
					</form>
				</div>

				<!-- Verification Result -->
				@if(request('registration_no') && request('dob'))
					@php
						$student = DB::table('students')
							->where('s_reg_no', request('registration_no'))
							->where('s_dob', request('dob'))
							->first();
					@endphp

					@if($student)
						<div class="verification-result" style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); margin-top: 20px;">
							<div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
								<i class="fa fa-check-circle"></i> <strong>Registration Verified Successfully!</strong>
							</div>
							<div class="row">
								<div class="col-md-3 text-center mb-3">
									@if($student->s_photo)
										<img src="{{ asset($student->s_photo) }}" alt="Student Photo" style="width: 150px; height: 180px; object-fit: cover; border: 3px solid #0d8aee; border-radius: 8px;">
									@else
										<div style="width: 150px; height: 180px; background: #f0f0f0; border: 3px solid #0d8aee; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
											<i class="fa fa-user" style="font-size: 60px; color: #ccc;"></i>
										</div>
									@endif
								</div>
								<div class="col-md-9">
									<table class="table table-bordered" style="background: #fff;">
										<tr>
											<th style="width: 200px; background: #f8f9fa;">Registration No</th>
											<td><strong>{{ $student->s_reg_no }}</strong></td>
										</tr>
										<tr>
											<th style="background: #f8f9fa;">Student Name</th>
											<td>{{ $student->s_name }}</td>
										</tr>
										<tr>
											<th style="background: #f8f9fa;">Father's Name</th>
											<td>{{ $student->s_father_name ?? 'N/A' }}</td>
										</tr>
										<tr>
											<th style="background: #f8f9fa;">Date of Birth</th>
											<td>{{ \Carbon\Carbon::parse($student->s_dob)->format('d-M-Y') }}</td>
										</tr>
										<tr>
											<th style="background: #f8f9fa;">Course</th>
											<td>{{ $student->s_course ?? 'N/A' }}</td>
										</tr>
										<tr>
											<th style="background: #f8f9fa;">Center Name</th>
											<td>{{ $student->s_center_name ?? 'N/A' }}</td>
										</tr>
										<tr>
											<th style="background: #f8f9fa;">Status</th>
											<td><span class="badge" style="background: #28a745; color: #fff; padding: 5px 15px; border-radius: 20px;">Verified</span></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					@else
						<div class="verification-result" style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); margin-top: 20px;">
							<div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; text-align: center;">
								<i class="fa fa-times-circle"></i> <strong>No Record Found!</strong> Please check your Registration No and Date of Birth.
							</div>
						</div>
					@endif
				@endif
			</div>
		</div>
		<!-- Registration Verification Section End -->
		
@endsection