@extends('frontend.layouts.master')
@section('title','Contact Us')
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
		                    <h1 class="page-title">Contact</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
		                        <li>Cantact</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div><!-- .breadcrumbs-inner end -->
		</div>
		<!-- Breadcrumbs End -->
		
		<!-- Contact Info Cards Start -->
		<style>
		.contact-cards-section {
			padding: 60px 0;
			background: #f8f9fa;
		}
		.contact-cards-wrapper {
			background: linear-gradient(135deg, #000055 0%, #000077 50%, #000088 100%);
			border-radius: 15px;
			padding: 40px 30px;
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
		}
		.contact-card {
			text-align: center;
			padding: 20px 15px;
		}
		.contact-card i {
			font-size: 32px;
			color: #ff6b35;
			margin-bottom: 15px;
			display: inline-block;
			width: 70px;
			height: 70px;
			line-height: 70px;
			background: rgba(255, 107, 53, 0.15);
			border-radius: 50%;
			transition: all 0.3s ease;
		}
		.contact-card:hover i {
			background: #ff6b35;
			color: #fff;
			transform: scale(1.1);
		}
		.contact-card h4 {
			color: #ffffff;
			font-size: 16px;
			font-weight: 600;
			margin-bottom: 10px;
		}
		.contact-card p, .contact-card a {
			color: #a8b8d0;
			font-size: 13px;
			line-height: 1.5;
			margin: 0;
			text-decoration: none;
		}
		.contact-card a:hover {
			color: #ff6b35;
		}
		.contact-cards-wrapper .col-lg-3:not(:last-child) .contact-card {
			border-right: 1px solid rgba(255, 255, 255, 0.1);
		}
		@media (max-width: 991px) {
			.contact-cards-wrapper .col-lg-3:not(:last-child) .contact-card {
				border-right: none;
			}
			.contact-card {
				padding: 20px 10px;
			}
		}

		/* Contact Form Styling */
		.contact-form-section {
			background: #f8f9fa;
			padding: 60px 0;
		}
		.contact-form-wrapper {
			background: #ffffff;
			border-radius: 15px;
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
			padding: 40px;
		}
		.contact-form-wrapper h3 {
			color: #000077;
			font-size: 28px;
			font-weight: 700;
			margin-bottom: 10px;
			text-align: center;
		}
		.contact-form-wrapper .subtitle {
			color: #666;
			text-align: center;
			margin-bottom: 30px;
		}
		.contact-form-wrapper .form-group {
			margin-bottom: 20px;
		}
		.contact-form-wrapper label {
			font-weight: 600;
			color: #333;
			margin-bottom: 8px;
			display: block;
		}
		.contact-form-wrapper .form-control {
			border: 2px solid #e0e0e0;
			border-radius: 8px;
			padding: 12px 15px;
			font-size: 14px;
			transition: all 0.3s ease;
		}
		.contact-form-wrapper .form-control:focus {
			border-color: #000077;
			box-shadow: 0 0 0 3px rgba(0, 0, 119, 0.1);
		}
		.contact-form-wrapper textarea.form-control {
			min-height: 150px;
			resize: vertical;
		}
		.contact-form-wrapper .btn-submit {
			background: linear-gradient(135deg, #000077 0%, #000099 100%);
			color: #fff;
			border: none;
			padding: 15px 40px;
			font-size: 16px;
			font-weight: 600;
			border-radius: 8px;
			cursor: pointer;
			transition: all 0.3s ease;
			display: inline-block;
		}
		.contact-form-wrapper .btn-submit:hover {
			background: linear-gradient(135deg, #000099 0%, #0000bb 100%);
			transform: translateY(-2px);
			box-shadow: 0 5px 20px rgba(0, 0, 119, 0.3);
		}
		.map-wrapper {
			border-radius: 15px;
			overflow: hidden;
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
			height: 100%;
			min-height: 400px;
		}
		.map-wrapper iframe {
			width: 100%;
			height: 100%;
			min-height: 400px;
			border: none;
		}
		</style>

		<div class="contact-cards-section">
			<div class="container">
				<div class="contact-cards-wrapper">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="contact-card">
								<i class="fa fa-map-marker"></i>
								<h4>Register Office</h4>
								<p>K-40/B, First Floor, New Govindpura Extension, Delhi-110051</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="contact-card">
								<i class="fa fa-building"></i>
								<h4>Corporate Office</h4>
								<p>Siswar, Phulparas, Madhubani, Bihar - 847409</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="contact-card">
								<i class="fa fa-phone"></i>
								<h4>Phone Number</h4>
								<a href="tel:{{$data->phone ?? ''}}">{{$data->phone ?? '+918825148127'}}</a>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="contact-card">
								<i class="fa fa-envelope"></i>
								<h4>Email Address</h4>
								<a href="mailto:{{$data->email ?? ''}}">{{$data->email ?? 'mccsiswar@gmail.com'}}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Contact Info Cards End -->

		<!-- Contact Form Section Start -->
		<div class="contact-form-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
						<div class="contact-form-wrapper">
							<h3>Get In Touch</h3>
							<p class="subtitle">We'd love to hear from you. Send us a message!</p>
							<div id="form-messages"></div>
							<form id="contact-form" method="post">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>First Name *</label>
											<input name="fname" id="fname" class="form-control" type="text" placeholder="Enter first name" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name *</label>
											<input name="lname" id="lname" class="form-control" type="text" placeholder="Enter last name" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Email *</label>
											<input name="email" id="email" class="form-control" type="email" placeholder="Enter email address" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Subject *</label>
											<input name="subject" id="subject" class="form-control" type="text" placeholder="Enter subject" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Message *</label>
									<textarea id="message" name="message" class="form-control" placeholder="Write your message here..." required></textarea>
								</div>
								<div class="text-center">
									<button type="submit" class="btn-submit">Send Message</button>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="map-wrapper">
							<iframe src="{{$data->map ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.0876407!2d77.2819!3d28.6692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjjCsDQwJzA5LjEiTiA3N8KwMTYnNTQuOCJF!5e0!3m2!1sen!2sin!4v1234567890'}}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- Contact Form Section End -->  
@endsection