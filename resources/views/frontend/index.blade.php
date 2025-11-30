@extends('frontend.layouts.master')
@section('title','Home')
@section('content')

<!-- Slider Area Start -->
<div id="rs-slider" class="slider-overlay-2">
    <div id="home-slider" class="rs-carousel owl-carousel"
        data-loop="true"
        data-items="1"
        data-margin="0"
        data-autoplay="true"
        data-autoplay-timeout="5000"
        data-smart-speed="1200"
        data-dots="false"
        data-nav="true"
        data-nav-speed="false"
        data-mobile-device="1"
        data-mobile-device-nav="true"
        data-mobile-device-dots="true"
        data-ipad-device="1"
        data-ipad-device-nav="true"
        data-ipad-device-dots="true"
        data-md-device="1"
        data-md-device-nav="true"
        data-md-device-dots="false">

        @php
            $banners = DB::table('cms_banner')->orderBy('id','DESC')->get();
        @endphp

        @foreach($banners as $banner)
        <div class="item">
            <img src="{{ asset($banner->file) }}" alt="Banner"  style="height:40vh;" />

            <div class="slide-content">
                <div class="display-table">
                    <div class="display-table-cell">
                        <div class="container text-center">
                            <!-- <a href="#" class="sl-readmore-btn mr-30" data-animation-in="lightSpeedIn"
                               data-animation-out="animate-out">READ MORE</a>
                            <a href="#" class="sl-get-started-btn" data-animation-in="lightSpeedIn"
                               data-animation-out="animate-out">GET STARTED NOW</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
<!-- Slider Area End -->


<!-- Services Start -->
<div class="rs-services rs-services-style1" style="margin-top:100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="services-item rs-animation-hover">
                    <div class="services-icon">
                        <i class="fa fa-american-sign-language-interpreting rs-animation-scale-up"></i>
                    </div>
                    <div class="services-desc">
                        <h4 class="services-title">Trending Courses</h4>
                        <p>Lorem ipsum dolor sit amet Sed nec molestie justo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="services-item rs-animation-hover">
                    <div class="services-icon">
                        <i class="fa fa-book rs-animation-scale-up"></i>
                    </div>
                    <div class="services-desc">
                        <h4 class="services-title">Books & Liberary</h4>
                        <p>Lorem ipsum dolor sit amet Sed nec molestie justo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="services-item rs-animation-hover">
                    <div class="services-icon">
                        <i class="fa fa-user rs-animation-scale-up"></i>
                    </div>
                    <div class="services-desc">
                        <h4 class="services-title">Certified Teachers</h4>
                        <p>Lorem ipsum dolor sit amet Sed nec molestie justo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="services-item rs-animation-hover">
                    <div class="services-icon">
                        <i class="fa fa-graduation-cap rs-animation-scale-up"></i>
                    </div>
                    <div class="services-desc">
                        <h4 class="services-title">Certification</h4>
                        <p>Lorem ipsum dolor sit amet Sed nec molestie justo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- About Us Start -->
<div id="rs-about" class="rs-about sec-spacer">
    <div class="container">
        <div class="sec-title mb-50 text-center">
            <h2>ABOUT US</h2>
            <p>Fusce sem dolor, interdum in fficitur at, faucibus nec lorem. Sed nec molestie justo.</p>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="about-img rs-animation-hover">
                    <img src="{{asset('frontend/images/about/about.jpg')}}" alt="img02" />
                    <a class="popup-youtube rs-animation-fade" href="https://www.youtube.com/watch?v=tzMpWiGL8D8"
                        title="Video Icon">
                    </a>
                    <div class="overly-border"></div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-desc">
                    <h3>WELCOME TO EDULEARN</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua</p>
                </div>
                <div id="accordion" class="rs-accordion-style1">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h3 class="acdn-title" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                Our History
                            </h3>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordion">
                            <div class="card-body">
                                There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look even slightly believable.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h3 class="acdn-title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                Our Mission
                            </h3>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                            <div class="card-body">
                                There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look even slightly believable.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header mb-0" id="headingThree">
                            <h3 class="acdn-title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                Our Vision
                            </h3>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordion">
                            <div class="card-body">
                                There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look even slightly believable.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Us End -->

<!-- Courses Start -->
<div id="rs-courses" class="rs-courses sec-color sec-spacer d-none">
    <div class="container">
        <div class="sec-title mb-50 text-center">
            <h2>OUR POPULAR COURSES</h2>
            <p>Fusce sem dolor, interdum in fficitur at, faucibus nec lorem. Sed nec molestie justo.</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30"
                    data-autoplay="false" data-autoplay-timeout="5000" data-smart-speed="1200" data-dots="true"
                    data-nav="true" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true"
                    data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="true"
                    data-ipad-device-dots="true" data-md-device="3" data-md-device-nav="true"
                    data-md-device-dots="true">
                    <div class="cource-item">
                        <div class="cource-img">
                            <img src="images/courses/1.jpg" alt="" />
                            <a class="image-link" href="courses-details.html" title="University Tour 2018">
                                <i class="fa fa-link"></i>
                            </a>
                            <span class="course-value">$450</span>
                        </div>
                        <div class="course-body">
                            <a href="#" class="course-category">Science</a>
                            <h4 class="course-title"><a href="courses-details.html">Electrical Engineering</a></h4>
                            <div class="review-wrap">
                                <ul class="rating">
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star-half-empty"></li>
                                </ul>
                                <span class="review">25 Reviews</span>
                            </div>
                            <div class="course-desc">
                                <p>
                                    Cras ultricies lacus consectetur, consectetur
                                    scelerisque arcu curabitur
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-time">
                                <span class="label">Course Time</span>
                                <span class="desc">3 Year</span>
                            </div>
                            <div class="course-student">
                                <span class="label">Course Student</span>
                                <span class="desc">95</span>
                            </div>
                            <div class="class-duration">
                                <span class="label">Class Duration</span>
                                <span class="desc">8:30-4:00</span>
                            </div>
                        </div>
                    </div>
                    <div class="cource-item">
                        <div class="cource-img">
                            <img src="images/courses/2.jpg" alt="" />
                            <a class="image-link" href="courses-details.html" title="University Tour 2018">
                                <i class="fa fa-link"></i>
                            </a>
                            <span class="course-value">$450</span>
                        </div>
                        <div class="course-body">
                            <a href="#" class="course-category">Science</a>
                            <h4 class="course-title"><a href="courses-details.html">Computer Engineering</a></h4>
                            <div class="review-wrap">
                                <ul class="rating">
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star-half-empty"></li>
                                </ul>
                                <span class="review">39 Reviews</span>
                            </div>
                            <div class="course-desc">
                                <p>
                                    Cras ultricies lacus consectetur, consectetur
                                    scelerisque arcu curabitur
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-time">
                                <span class="label">Course Time</span>
                                <span class="desc">4 Years</span>
                            </div>
                            <div class="course-student">
                                <span class="label">Course Student</span>
                                <span class="desc">99</span>
                            </div>
                            <div class="class-duration">
                                <span class="label">Class Duration</span>
                                <span class="desc">8:30-4:00</span>
                            </div>
                        </div>
                    </div>
                    <div class="cource-item">
                        <div class="cource-img">
                            <img src="images/courses/3.jpg" alt="" />
                            <a class="image-link" href="courses-details.html" title="University Tour 2018">
                                <i class="fa fa-link"></i>
                            </a>
                            <span class="course-value">$450</span>
                        </div>
                        <div class="course-body">
                            <a href="#" class="course-category">Science</a>
                            <h4 class="course-title"><a href="courses-details.html">Civil Engineering</a></h4>
                            <div class="review-wrap">
                                <ul class="rating">
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star"></li>
                                    <li class="fa fa-star-half-empty"></li>
                                </ul>
                                <span class="review">22 Reviews</span>
                            </div>
                            <div class="course-desc">
                                <p>
                                    Cras ultricies lacus consectetur, consectetur
                                    scelerisque arcu curabitur
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-time">
                                <span class="label">Course Time</span>
                                <span class="desc">3.5 Years</span>
                            </div>
                            <div class="course-student">
                                <span class="label">Course Student</span>
                                <span class="desc">80</span>
                            </div>
                            <div class="class-duration">
                                <span class="label">Class Duration</span>
                                <span class="desc">8:30-4:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Courses End -->

<!-- Counter Up Section Start-->
<div class="rs-counter pt-100 pb-70 bg3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="counter-content">
                    <h2 class="counter-title">ACHEIVEMENTS</h2>
                    <div class="counter-text">
                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of
                            spring which I enjoy with my whole heart like mine.</p>
                    </div>
                    <div class="counter-img rs-image-effect-shine">
                        <img src="{{asset('frontend/images/counter/1.jpg')}}" alt="Counter Discussion">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mt-80">
                <div class="row">
                    <div class="col-md-6">
                        <div class="rs-counter-list">
                            <h2 class="counter-number plus">60</h2>
                            <h4 class="counter-desc">TEACHERS</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rs-counter-list">
                            <h2 class="counter-number plus">40</h2>
                            <h4 class="counter-desc">COURSES</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="rs-counter-list">
                            <h2 class="counter-number plus">900</h2>
                            <h4 class="counter-desc">STUDENTS</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rs-counter-list">
                            <h2 class="counter-number plus">3675</h2>
                            <h4 class="counter-desc">Satisfied Client</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counter Down Section End -->


<!-- Calltoaction Start -->
<div id="rs-calltoaction" class="rs-calltoaction sec-spacer bg4">
    <div class="container">
        <div class="rs-cta-inner text-center">
            <div class="sec-title mb-50 text-center">
                <h2 class="white-color">WEB DESIGN &amp; DEVLOPMENT COURSE</h2>
                <p class="white-color">Fusce sem dolor, interdum in efficitur at, faucibus nec lorem.</p>
            </div>
            <a class="cta-button" href="#">Join Now</a>
        </div>
    </div>
</div>
<!-- Calltoaction End -->


<!-- Newslatter Start -->
<!--
        <div id="rs-newslatter" class="rs-newslatter sec-black sec-spacer">
            <div class="container">
                <div class="row rs-vertical-middle">
                    <div class="col-md-6">
                        <h3 class="newslatter-title">STAY CONNECTED WITH US</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <form class="newslatter-form">
                            <input type="text" class="form-input" placeholder="Enter Your Email Address">
                            <button type="submit" class="form-button">SUBSCRIBE</button>
                        </form>						
                    </div>
                </div>
            </div>
        </div>
-->


<!-- Partner Start -->
<div id="rs-partner" class="rs-partner pt-70 pb-70">
    <div class="container">
        <div class="rs-carousel owl-carousel" data-loop="true" data-items="5" data-margin="80" data-autoplay="true"
            data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="false"
            data-nav-speed="false" data-mobile-device="2" data-mobile-device-nav="false" data-mobile-device-dots="false"
            data-ipad-device="4" data-ipad-device-nav="false" data-ipad-device-dots="false" data-md-device="5"
            data-md-device-nav="false" data-md-device-dots="false">
            <div class="partner-item">
                <a href="#"><img src="{{asset('frontend/images/partner/1.png')}}" alt="Partner Image"></a>
            </div>
            <div class="partner-item">
                <a href="#"><img src="{{asset('frontend/images/partner/2.png')}}" alt="Partner Image"></a>
            </div>
            <div class="partner-item">
                <a href="#"><img src="{{asset('frontend/images/partner/3.png')}}" alt="Partner Image"></a>
            </div>
            <div class="partner-item">
                <a href="#"><img src="{{asset('frontend/images/partner/4.png')}}" alt="Partner Image"></a>
            </div>
            <div class="partner-item">
                <a href="#"><img src="{{asset('frontend/images/partner/5.png')}}" alt="Partner Image"></a>
            </div>
        </div>
    </div>
</div>
<!-- Partner End -->


@endsection