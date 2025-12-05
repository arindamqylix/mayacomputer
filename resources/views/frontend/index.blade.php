@extends('frontend.layouts.master')
@section('title','Home')
@section('content')

<!-- Slider Area Start -->
<div id="rs-slider" class="">
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


<!-- Counter Stats Start -->
<style>
.counter-stats-section {
    background: linear-gradient(135deg, #000055 0%, #000077 50%, #000088 100%);
    padding: 50px 0;
    margin: 0;
}
.counter-item {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 15px;
    border-right: 1px solid rgba(255, 255, 255, 0.15);
}
.counter-item:last-child {
    border-right: none;
}
.counter-icon {
    margin-right: 20px;
}
.counter-icon i {
    font-size: 38px;
    color: #ff6b35;
}
.counter-content h3 {
    font-size: 34px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    line-height: 1;
}
.counter-content p {
    font-size: 13px;
    color: #a8b8d0;
    margin: 8px 0 0 0;
}
@media (max-width: 991px) {
    .counter-item {
        border-right: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        padding: 25px 15px;
    }
    .counter-item:last-child {
        border-bottom: none;
    }
}
@media (max-width: 767px) {
    .counter-content h3 {
        font-size: 28px;
    }
    .counter-icon i {
        font-size: 32px;
    }
}
</style>
<div class="counter-stats-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="counter-content">
                        <h3>50707+</h3>
                        <p>Students Enrolled</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="counter-content">
                        <h3>129+</h3>
                        <p>Courses Available</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fa fa-trophy"></i>
                    </div>
                    <div class="counter-content">
                        <h3>8+</h3>
                        <p>Years Experience</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="counter-content">
                        <h3>95%</h3>
                        <p>Placement Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counter Stats End -->

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
<style>
.partners-section {
    background-color: #f9f9f9;
    padding: 80px 0;
    position: relative;
}
.partners-section .sec-title {
    margin-bottom: 50px;
}
.partners-section .sec-title h2 {
    font-size: 32px;
    font-weight: 700;
    color: #212121;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    padding-bottom: 20px;
}
.partners-section .sec-title h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #d00226 0%, #ff6b35 100%);
    border-radius: 2px;
}
.partners-section .sec-title p {
    font-size: 16px;
    color: #666;
    margin-bottom: 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}
.partner-carousel-wrapper {
    position: relative;
    padding: 20px 0;
}
.partner-item {
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 120px;
    transition: all 0.3s ease;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin: 10px;
}
.partner-item a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    transition: all 0.3s ease;
}
.partner-item img {
    max-width: 100%;
    max-height: 80px;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: all 0.3s ease;
}
.partner-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    background: #ffffff;
}
.partner-item:hover img {
    transform: scale(1.05);
}
.partner-item:hover a {
    color: inherit;
}
@media (max-width: 991px) {
    .partners-section {
        padding: 60px 0;
    }
    .partners-section .sec-title h2 {
        font-size: 26px;
    }
    .partner-item {
        height: 100px;
    }
    .partner-item img {
        max-height: 60px;
    }
}
@media (max-width: 767px) {
    .partners-section {
        padding: 50px 0;
    }
    .partners-section .sec-title {
        margin-bottom: 30px;
    }
    .partners-section .sec-title h2 {
        font-size: 22px;
        padding-bottom: 15px;
    }
    .partners-section .sec-title p {
        font-size: 14px;
    }
    .partner-item {
        height: 90px;
        margin: 8px;
    }
    .partner-item img {
        max-height: 50px;
    }
}
</style>
<div id="rs-partner" class="partners-section">
    <div class="container">
        <div class="sec-title text-center">
            <h2>Our Partners</h2>
            <p>We are proud to collaborate with leading organizations and institutions</p>
        </div>
        <div class="partner-carousel-wrapper">
            <div class="rs-carousel owl-carousel" data-loop="true" data-items="5" data-margin="30" data-autoplay="true"
                data-autoplay-timeout="4000" data-smart-speed="1500" data-dots="false" data-nav="false"
                data-nav-speed="false" data-mobile-device="2" data-mobile-device-nav="false" data-mobile-device-dots="false"
                data-ipad-device="3" data-ipad-device-nav="false" data-ipad-device-dots="false" data-md-device="4"
                data-md-device-nav="false" data-md-device-dots="false">
                <div class="partner-item">
                    <a href="#" title="Partner 1">
                        <img src="{{asset('frontend/images/partner/1.png')}}" alt="Partner Logo">
                    </a>
                </div>
                <div class="partner-item">
                    <a href="#" title="Partner 2">
                        <img src="{{asset('frontend/images/partner/2.png')}}" alt="Partner Logo">
                    </a>
                </div>
                <div class="partner-item">
                    <a href="#" title="Partner 3">
                        <img src="{{asset('frontend/images/partner/3.png')}}" alt="Partner Logo">
                    </a>
                </div>
                <div class="partner-item">
                    <a href="#" title="Partner 4">
                        <img src="{{asset('frontend/images/partner/4.png')}}" alt="Partner Logo">
                    </a>
                </div>
                <div class="partner-item">
                    <a href="#" title="Partner 5">
                        <img src="{{asset('frontend/images/partner/5.png')}}" alt="Partner Logo">
                    </a>
                </div>
                <div class="partner-item">
                    <a href="#" title="Partner 6">
                        <img src="{{asset('frontend/images/partner/6.jpg')}}" alt="Partner Logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Partner End -->


@endsection