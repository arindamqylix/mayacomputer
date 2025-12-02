@extends('frontend.layouts.master')
@section('title','Gallery')
@section('content')
<!-- Breadcrumbs Start -->
		<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
		    <div class="breadcrumbs-inner">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-12 text-center">
		                    <h1 class="page-title">{{$data->c_full_name ?? ''}}</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
                                <li>
		                            <a class="active" href="{{route('courses')}}">Course</a>
		                        </li>
		                        <li>{{$data->c_full_name ?? ''}}</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- Breadcrumbs End -->

		<!-- Courses Details Start -->
        <div class="rs-courses-details pt-100 pb-70">
            <div class="container">
                <div class="row mb-30">
                    <div class="col-lg-8 col-md-12">
                	    <div class="detail-img">
                	        <img src="{{asset($data->file)}}" alt="Courses Images" />
                	        <!-- <div class="course-seats">
                	        	170 <span>SEATS</span>
                	        </div> -->
                	    </div>
                	    <div class="course-content">
                	    	<!--<h3 class="course-title">Computer Science And Engineering</h3>-->
                	    	<div class="course-instructor">
                	    		<div class="row">
                	    			<!-- <div class="col-md-6 mobile-mb-20">
                	    				<h3 class="instructor-title">COURSE <span class="primary-color">INSTRUCTOR</span></h3>
                	    				<div class="instructor-inner">
                	    					<div class="instructor-img">
                	    						<img src="images/teachers/2.jpg" alt="Teachers Images" />
                	    					</div>
                	    					<div class="instructor-body">
                	    						<h3 class="name">Garade Pickey Moon</h3>
                	    						<span class="designation">English Professor</span>
                	    						<div class="social-icon">
                	    							<a href="#"><i class="fa fa-facebook"></i></a>
                	    							<a href="#"><i class="fa fa-twitter"></i></a>
                	    							<a href="#"><i class="fa fa-google-plus"></i></a>
                	    							<a href="#"><i class="fa fa-linkedin"></i></a>
                	    						</div>
                	    					</div>
                	    				</div>
                	    				<div class="short-desc">
                	    					<p>There are many variations of passages of Lorem Ipsum available</p>
                	    				</div>
                	    			</div> -->
                	    			@php
                                        $information = json_decode($data->information, true);
                                    @endphp

                                    @if(!empty($information))
                                    <div class="col-md-12">
                                        <h3 class="instructor-title">BASIC <span class="primary-color">INFORMATION</span></h3>
                                        <div class="row info-list">

                                            @php
                                                // split list in two columns
                                                $half = ceil(count($information) / 2);
                                                $left = array_slice($information, 0, $half);
                                                $right = array_slice($information, $half);
                                            @endphp

                                            <div class="col-md-6">
                                                <ul>
                                                    @foreach($left as $info)
                                                    <li>
                                                        <span>{{ $info['title'] ?? '' }} :</span>
                                                        {{ $info['value'] ?? '' }}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <div class="col-md-6">
                                                <ul>
                                                    @foreach($right as $info)
                                                    <li>
                                                        <span>{{ $info['title'] ?? '' }} :</span>
                                                        {{ $info['value'] ?? '' }}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="apply-btn">
                                            <a href="#">APPLY NOW</a>
                                        </div>
                                    </div>
                                    @endif

                	    		</div>
                	    	</div>
                	    </div>
                	    <div class="course-desc">
                	    	<h3 class="desc-title">Course Description</h3>
                	    	<div class="desc-text">
                	    		{!! $data->description??'' !!}
                	    	</div>
                            @php
                                $syllabus = json_decode($data->course_syllabus, true);
                            @endphp

                            @if(!empty($syllabus))
                            <div class="course-syllabus">
                                <h3 class="desc-title">Course Syllabus</h3>
                                <div id="accordion" class="rs-accordion-style1">

                                    @foreach($syllabus as $index => $item)
                                    <div class="card">
                                        <div class="card-header" id="heading{{ $index }}">
                                            <h3 class="acdn-title" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $index }}"
                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $index }}">
                                                <strong>Lessons {{ $index + 1 }}: </strong>
                                                <span>{{ $item['name'] ?? '' }}</span>
                                            </h3>
                                        </div>

                                        <div id="collapse{{ $index }}"
                                            class="collapse {{ $index == 0 ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $index }}"
                                            data-bs-parent="#accordion">
                                            <div class="card-body">
                                                {!! $item['desc'] ?? '' !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            @endif

                            <!-- Testimonial End -->
<!--
                	    	<div class="share-area">
                	    		<div class="row rs-vertical-middle">
                	    			<div class="col-md-5">
                	    				<h3>You Can Share It :</h3>
                	    			</div>
                	    			<div class="col-md-7">
                	    				<div class="share-inner">
                	    					<a href="#"><i class="fa fa-facebook"></i> Facebook</a>
                	    					<a href="#"><i class="fa fa-twitter"></i> Twitter</a>
                	    					<a href="#"><i class="fa fa-google"></i> Google</a>
                	    				</div>
                	    			</div>
                	    		</div>
                	    	</div>
-->
                	    </div>
                    </div>
                    <!-- <div class="col-lg-4 col-md-12">
                        <div class="sidebar-area">
                            <div class="search-box">
                                <h3 class="title">Search Courses</h3>
                                <div class="box-search">
                                    <input class="form-control" placeholder="Search Here ..." name="srch-term" id="srch-term" type="text">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="cate-box">
                                <h3 class="title">Courses Categories</h3>
                                <ul>
                                    <li>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Analysis & Features <span>(05)</span></a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Video Reviews <span>(07)</span></a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Engineering Tech <span>(09)</span></a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#"> Righteous Indignation <span>(08)</span></a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">General Education <span>(04)</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="latest-courses">
                                <h3 class="title">Latest Courses</h3>
                                <div class="post-item">
	                                <div class="post-img">
	                                    <a href="courses-details.html"><img src="images/blog-details/sm1.jpg" alt="" title="News image"></a>
	                                </div>
	                                <div class="post-desc">
	                                    <h4><a href="courses-details.html">Raken develops reporting The software</a></h4>
	                                    <span class="duration"> 
	                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
	                                    </span> 
	                                    <span class="price">Price: <span>$350</span></span>
	                                </div>
	                            </div>
	                            <div class="post-item">
	                                <div class="post-img">
	                                    <a href="courses-details.html"><img src="images/blog-details/sm2.jpg" alt="" title="News image"></a>
	                                </div>
	                                <div class="post-desc">
	                                    <h4><a href="courses-details.html">Raken develops reporting The software</a></h4>
	                                    <span class="duration"> 
	                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
	                                    </span> 
	                                    <span class="price">Price: <span>$350</span></span>
	                                </div>
	                            </div>
	                            <div class="post-item">
	                                <div class="post-img">
	                                    <a href="courses-details.html"><img src="images/blog-details/sm3.jpg" alt="" title="News image"></a>
	                                </div>
	                                <div class="post-desc">
	                                    <h4><a href="courses-details.html">Raken develops reporting The software</a></h4>
	                                    <span class="duration"> 
	                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
	                                    </span> 
	                                    <span class="price">Price: <span>$350</span></span>
	                                </div>
	                            </div>
                            </div>
                            <div class="tags-cloud clearfix">
                                <h3 class="title">courses Tags</h3>
                                <ul>
                                    <li>
                                        <a href="#">SCIENCE</a>
                                    </li>
                                    <li>
                                        <a href="#">HUMANITIES</a>
                                    </li>
                                    <li>
                                        <a href="#">DIPLOMA</a>
                                    </li>
                                    <li>
                                        <a href="#">BUSINESS</a>
                                    </li>
                                    <li>
                                        <a href="#">SPROTS</a>
                                    </li>
                                    <li>
                                        <a href="#">RESEARCH</a>
                                    </li>
                                    <li>
                                        <a href="#">ARTS</a>
                                    </li>
                                    <li>
                                        <a href="#">ADMISSIONS</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            
        </div>
        <!-- Courses Details End -->
@endsection