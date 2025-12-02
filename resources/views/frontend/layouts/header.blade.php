@php
	$data = DB::table('site_settings')->where('id','1')->first();
@endphp
<!--Full width header Start-->
<div class="full-width-header">

	<!-- Toolbar Start -->
	<div class="rs-toolbar">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="rs-toolbar-left">
						<div class="welcome-message">
							<i class="fa fa-bank"></i><span>Welcome to Maya Computer Center Private Limited</span>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="rs-toolbar-right">
						<div class="toolbar-share-icon">
							<ul>
								<li><a href="#" style="color:#fff;"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#" style="color:#fff;"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#" style="color:#fff;"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#" style="color:#fff;"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						</div>
						<!-- <a href="#" class="apply-btn">Apply Now</a> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Toolbar End -->

	<!--Header Start-->
	<header id="rs-header" class="rs-header">

		<!-- Header Top Start -->
		<div class="rs-header-top">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-12">
						<div class="header-contact">
							<div id="info-details" class="widget-text">
								<i class="glyph-icon flaticon-email"></i>
								<div class="info-text">
									<a href="mailto:imccsiswar@gmail.com">
										<span>Mail Us</span>
										mccsiswar@gmail.com
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="logo-area text-center">
							<a href="{{url('/')}}"><img src="{{asset($data->site_logo)}}" alt="logo"></a>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="header-contact pull-right">
							<div id="phone-details" class="widget-text">
								<i class="glyph-icon flaticon-phone-call"></i>
								<div class="info-text">
									<a href="tel:8825148127">
										<span>Call Us</span>
										+918825148127
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Top End -->

		<!-- Menu Start -->
		<div class="menu-area menu-sticky">
			<div class="container">
				<div class="main-menu">
					<div class="row relative">
						<div class="col-sm-12">
							<!-- <div id="logo-sticky" class="text-center">
										<a href="index.html"><img src="images/logo.png" alt="logo"></a>
									</div> -->
							<a class="rs-menu-toggle" style="font-size: 20px;font-weight: bold;"><i class="fa fa-bars"></i>Menu</a>
							<nav class="rs-menu">
								<ul class="nav-menu">
									<!-- Home -->
									<li class="current-menu-item current_page_item">
										<a href="{{ route('index') }}" class="home">Home</a>
									</li>
									<!-- End Home -->

									<!--About Menu Start-->
									<li class="menu-item-has-children">
										<a href="{{route('aboutus')}}">About Us</a>
										<ul class="sub-menu">
											<li><a href="{{ route('director') }}">Director</a></li>
											<li><a href="{{ route('teacher') }}">Teacher</a></li>
										</ul>
									</li>
									<!--About Menu End-->

									<!--Courses Menu Start-->
									@php
										$course = DB::table('course')->get();
									@endphp
									<li class="menu-item-has-children">
										<a href="#">Courses</a>
										<ul class="sub-menu">
											@foreach ($course as $val)
												<li><a href="{{route('courses.details',$val->slug??'')}}">{{$val->c_full_name ??''}}</a></li>
											@endforeach
										</ul>
									</li>
									<!--Courses Menu End-->

									<!--Verification Menu Start-->
									<li class="menu-item-has-children">
										<a href="#">Verification</a>
										<ul class="sub-menu">
											<li><a href="{{ route('verification.registration') }}">Registration
													Verification</a></li>
											<li><a href="{{ route('verification.icard') }}">I-Card Verification</a></li>
											<li><a href="{{ route('verification.result') }}">Result Verification</a>
											</li>
											<li><a href="{{ route('verification.certificate') }}">Certificate
													Verification</a></li>
											<li><a href="{{ route('verification.typing') }}">Typing Certificate
													Verification</a></li>
										</ul>
									</li>
									<!--Verification Menu End-->

									<!--Downloads Menu Start-->
									<li class="menu-item-has-children">
										<a href="#">Downloads</a>
										<ul class="sub-menu">
											@php
												$download = DB::table('cms_downloads')->get();	
											@endphp
											

											@foreach ($download as $val)
												<li><a href="{{route('downloads.document',$val->slug??'')}}">{{$val->download_name}}</a></li>
											@endforeach
										</ul>
									</li>
									<!--Downloads Menu End-->

									<!--Gallery Menu Start-->
									<li>
										<a href="{{ route('gallery') }}">Gallery</a>
									</li>
									<!--Gallery Menu End-->

									<!--Contact Menu Start-->
									<li>
										<a href="{{ route('contact') }}">Contact</a>
									</li>
									<!--Contact Menu End-->

									<!-- Login Dropdown Start -->
									<li class="menu-item-has-children">
										<a href="#">Login</a>
										<ul class="sub-menu">
											<li><a href="{{ url('center/login') }}">Center Login</a></li>
											<li><a href="{{ url('student/login') }}">Student Login</a></li>
										</ul>
									</li>
									<!-- Login Dropdown End -->
								</ul>

							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Menu End -->
	</header>
	<!--Header End-->

</div>
<!--Full width header End-->