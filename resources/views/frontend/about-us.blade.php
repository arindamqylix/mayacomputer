@extends('frontend.layouts.master')
@section('title','About Us')
@section('content')

<!-- Breadcrumbs Start -->
		<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
		    <div class="breadcrumbs-inner">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-12 text-center">
		                    <h1 class="page-title">About Us</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
		                        <li>About Us</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- Breadcrumbs End -->
		
		<!-- History Start -->
        <div class="rs-history sec-spacer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 rs-vertical-bottom mobile-mb-50">
                    	<a href="#">
							<img src="{{asset('frontend/images/about/history.jpg')}}" alt="History Image"/>
                    	</a>
                    </div>
                    <div class="col-lg-6 col-md-12">
		                <div class="abt-title">
		                    <h2>OUR HISTORY</h2>
		                </div>
                    	<div class="about-desc">
                			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius mod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehe derit in voluptate velit esse cillum.</p>

                			<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot fore see the pain and trouble that are bound to belongs to who fail in their duty.</p>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- History End -->

        <!-- Mission Start -->
        <div class="rs-mission sec-color sec-spacer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mobile-mb-50">
		                <div class="abt-title">
		                    <h2>OUR MISSION</h2>
		                </div>
                    	<div class="about-desc">
                			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius mod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehe derit in voluptate velit esse cillum.</p>

                			<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, that they cannot fore see the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty.</p>
                    	</div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                    	<div class="row">
                    		<div class="col-md-6 mobile-mb-30">
                    			<a href="#">
									<img src="{{asset('frontend/images/about/mission1.jpg')}}" alt="Mission Image"/>
		                    	</a> 
                    		</div>
                    		<div class="col-md-6">
		                    	<a href="#">
									<img src="{{asset('frontend/images/about/mission2.jpg')}}" alt="Mission Image"/>
		                    	</a>                 			
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mission End -->

        <!-- Vision Start -->
        <div class="rs-vision sec-spacer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mobile-mb-50">
                        <div class="vision-img rs-animation-hover">
							<img src="{{asset('frontend/images/about/vision.jpg')}}" alt="img02"/>
							<a class="popup-youtube rs-animation-fade" href="https://www.youtube.com/watch?v=3f9CAMoj3Ec" title="Video Icon">
							</a>
							<div class="overly-border"></div>
						</div>
                    </div>
                    <div class="col-lg-6 col-md-12">
		                <div class="abt-title">
		                    <h2>OUR VISION</h2>
		                </div>
                    	<div class="vision-desc">
                			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius mod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehe derit in voluptate velit esse cillum.</p>

                			<p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot fore see the pain and trouble that are bound to ensue; and equal who fail in their duty.</p>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vision End -->


	


@endsection