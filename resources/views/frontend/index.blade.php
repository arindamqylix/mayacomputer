@extends('frontend.layouts.master')
@section('title','Home')
@section('content')

<!-- All Custom Styles -->
<style>
/* Counter Stats Section */
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

/* Modern Courses Section */
#rs-courses.courses-slider-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #ffffff 100%) !important;
    padding: 80px 0 !important;
    position: relative;
    display: block !important;
    visibility: visible !important;
}
#rs-courses.courses-slider-section .section-header {
    text-align: center !important;
    margin-bottom: 50px !important;
}
#rs-courses.courses-slider-section .section-header h2 {
    font-size: 36px !important;
    font-weight: 700 !important;
    color: #000077 !important;
    margin-bottom: 15px !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    position: relative;
    display: inline-block !important;
}
.courses-slider-section .section-header h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #d00226 0%, #ff6b35 100%);
    border-radius: 2px;
}
.courses-slider-section .section-header p {
    font-size: 16px;
    color: #666;
    margin-top: 25px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}
.course-card-modern {
    background: #ffffff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    margin: 15px;
}
.course-card-modern:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}
.course-card-modern .course-image-wrapper {
    position: relative;
    overflow: hidden;
    height: 220px;
    background: linear-gradient(135deg, #000077 0%, #000099 100%);
}
.course-card-modern .course-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
}
.course-card-modern:hover .course-image-wrapper img {
    transform: scale(1.1);
}
.course-card-modern .course-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #d00226 0%, #ff6b35 100%);
    color: #ffffff;
    padding: 8px 18px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(208, 2, 38, 0.3);
}
.course-card-modern .course-content {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.course-card-modern .course-category {
    display: inline-block;
    background: rgba(0, 0, 119, 0.1);
    color: #000077;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.course-card-modern .course-title {
    font-size: 20px;
    font-weight: 700;
    color: #212121;
    margin-bottom: 15px;
    line-height: 1.4;
    min-height: 56px;
}
.course-card-modern .course-title a {
    color: #212121;
    transition: color 0.3s ease;
}
.course-card-modern .course-title a:hover {
    color: #d00226;
}
.course-card-modern .course-description {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.course-card-modern .course-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 15px 0;
    border-top: 1px solid #f0f0f0;
    margin-top: auto;
}
.course-card-modern .course-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #666;
    font-size: 13px;
}
.course-card-modern .course-meta-item i {
    color: #000077;
    font-size: 16px;
}
.course-card-modern .course-footer {
    padding: 0 25px 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.course-card-modern .course-price {
    font-size: 24px;
    font-weight: 700;
    color: #d00226;
}
.course-card-modern .course-price .currency {
    font-size: 16px;
    margin-right: 3px;
}
.course-card-modern .course-btn {
    background: linear-gradient(135deg, #000077 0%, #000099 100%);
    color: #ffffff;
    padding: 10px 25px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}
.course-card-modern .course-btn:hover {
    background: linear-gradient(135deg, #d00226 0%, #ff6b35 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0, 0, 119, 0.3);
}
@media (max-width: 768px) {
    .courses-slider-section {
        padding: 60px 0;
    }
    .courses-slider-section .section-header h2 {
        font-size: 26px;
    }
    .course-card-modern {
        margin: 10px;
    }
    .course-card-modern .course-image-wrapper {
        height: 180px;
    }
}

/* Why Choose Us Section */
.why-choose-section {
    background: #ffffff;
    padding: 80px 0;
}
.why-choose-section .section-header {
    text-align: center;
    margin-bottom: 60px;
}
.why-choose-section .section-header h2 {
    font-size: 36px;
    font-weight: 700;
    color: #000077;
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}
.why-choose-section .section-header h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #d00226 0%, #ff6b35 100%);
    border-radius: 2px;
}
.feature-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid #f0f0f0;
    height: 100%;
    margin-bottom: 30px;
}
.feature-card:hover {
    border-color: #000077;
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 119, 0.1);
}
.feature-card .feature-icon {
    width: 90px;
    height: 90px;
    margin: 0 auto 25px;
    background: linear-gradient(135deg, #000077 0%, #000099 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}
.feature-card:hover .feature-icon {
    background: linear-gradient(135deg, #d00226 0%, #ff6b35 100%);
    transform: scale(1.1);
}
.feature-card .feature-icon i {
    font-size: 40px;
    color: #ffffff;
}
.feature-card .feature-title {
    font-size: 20px;
    font-weight: 700;
    color: #212121;
    margin-bottom: 15px;
}
.feature-card .feature-desc {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}
@media (max-width: 768px) {
    .why-choose-section {
        padding: 60px 0;
    }
    .why-choose-section .section-header h2 {
        font-size: 26px;
    }
    .feature-card {
        padding: 30px 20px;
    }
}

/* Our Services Section */
.services-section {
    background: linear-gradient(135deg, #000055 0%, #000077 50%, #000088 100%);
    padding: 80px 0;
    position: relative;
}
.services-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.05)"/></svg>');
    opacity: 0.3;
}
.services-section .section-header {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
    z-index: 1;
}
.services-section .section-header h2 {
    font-size: 36px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    display: inline-block;
}
.services-section .section-header h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #d00226 0%, #ff6b35 100%);
    border-radius: 2px;
}
.services-section .section-header p {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.8);
    margin-top: 25px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}
.service-card {
    background: #ffffff;
    border-radius: 15px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
    z-index: 1;
}
.service-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(135deg, rgba(0, 0, 119, 0.05) 0%, rgba(208, 2, 38, 0.05) 100%);
    transform: rotate(45deg);
    transition: all 0.5s ease;
    opacity: 0;
}
.service-card:hover::before {
    opacity: 1;
    transform: rotate(45deg) translate(20%, 20%);
}
.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}
.service-card .service-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 25px;
    background: linear-gradient(135deg, #000077 0%, #000099 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}
.service-card:hover .service-icon {
    background: linear-gradient(135deg, #d00226 0%, #ff6b35 100%);
    transform: scale(1.1) rotate(5deg);
}
.service-card .service-icon i {
    font-size: 45px;
    color: #ffffff;
}
.service-card .service-title {
    font-size: 22px;
    font-weight: 700;
    color: #212121;
    margin-bottom: 15px;
    position: relative;
    z-index: 2;
}
.service-card .service-desc {
    color: #666;
    font-size: 14px;
    line-height: 1.7;
    margin: 0;
    position: relative;
    z-index: 2;
}
@media (max-width: 768px) {
    .services-section {
        padding: 60px 0;
    }
    .services-section .section-header h2 {
        font-size: 26px;
    }
    .service-card {
        padding: 30px 20px;
    }
}

/* Partners Section */
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

<!-- Why Choose Us Section Start -->
<div class="why-choose-section">
    <div class="container">
        <div class="section-header">
            <h2>Why Choose Us</h2>
            <p>Experience an excellence in computer education with our comprehensive programme and expert guidance</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h4 class="feature-title">Certified Courses</h4>
                    <p class="feature-desc">All our courses are industry-recognized and certified, providing you with valuable credentials for your career.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <h4 class="feature-title">Expert Instructors</h4>
                    <p class="feature-desc">Learn from experienced professionals and industry experts who are passionate about teaching and student success.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <h4 class="feature-title">Modern Labs</h4>
                    <p class="feature-desc">Practice in our well-equipped computer labs with the latest software and hardware infrastructure.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <h4 class="feature-title">Flexible Timing</h4>
                    <p class="feature-desc">Choose from various batch timings that fit your schedule, including weekend and evening classes.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <h4 class="feature-title">Job Placement</h4>
                    <p class="feature-desc">We provide placement assistance to help you secure rewarding job opportunities.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fa fa-support"></i>
                    </div>
                    <h4 class="feature-title">24/7 Support</h4>
                    <p class="feature-desc">Get assistance whenever you need it with our dedicated student support system available round the clock.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Us Section End -->

<!-- Courses Start -->
<div id="rs-courses" class="courses-slider-section">
    @php
        $courses = DB::table('cms_course')
            ->leftJoin('cms_course_category', 'cms_course.category_id', '=', 'cms_course_category.id')
            ->select('cms_course.*', 'cms_course_category.name as category_name')
            ->orderBy('cms_course.c_id', 'DESC')
            ->limit(12)
            ->get();
    @endphp
    <div class="container">
        <div class="section-header">
            <h2>OUR COURSES</h2>
            <p>Explore our comprehensive range of computer courses designed to enhance your skills and boost your career</p>
        </div>
        @if(count($courses) > 0)
        <div class="courses-carousel-wrapper">
            <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30"
                data-autoplay="true" data-autoplay-timeout="4000" data-smart-speed="1500" data-dots="true"
                data-nav="true" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true"
                data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="true"
                data-ipad-device-dots="true" data-md-device="3" data-md-device-nav="true"
                data-md-device-dots="true">
                @foreach($courses as $course)
                <div class="course-card-modern">
                    <div class="course-image-wrapper">
                        @if($course->file)
                            <img src="{{ asset($course->file) }}" alt="{{ $course->c_full_name ?? $course->c_short_name }}">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #000077 0%, #000099 100%);">
                                <i class="fa fa-book" style="font-size: 60px; color: rgba(255,255,255,0.3);"></i>
                            </div>
                        @endif
                        @if($course->category_name)
                        <div class="course-badge">{{ $course->category_name }}</div>
                        @endif
                    </div>
                    <div class="course-content">
                        @if($course->category_name)
                        <span class="course-category">{{ $course->category_name }}</span>
                        @endif
                        <h4 class="course-title">
                            <a href="{{ route('courses.details', $course->slug ?? $course->c_id) }}">
                                {{ $course->c_full_name ?? $course->c_short_name }}
                            </a>
                        </h4>
                        @if($course->description)
                        <p class="course-description">
                            {{ \Illuminate\Support\Str::limit(strip_tags($course->description), 120) }}
                        </p>
                        @endif
                        <div class="course-meta">
                            @if($course->c_duration)
                            <div class="course-meta-item">
                                <i class="fa fa-clock-o"></i>
                                <span>{{ $course->c_duration }}</span>
                            </div>
                            @endif
                            <div class="course-meta-item">
                                <i class="fa fa-certificate"></i>
                                <span>Certificate</span>
                            </div>
                        </div>
                    </div>
                    <div class="course-footer">
                        @if($course->c_price)
                        <div class="course-price">
                            <span class="currency">₹</span>{{ number_format($course->c_price, 0) }}
                        </div>
                        @else
                        <div class="course-price" style="font-size: 16px; color: #28a745;">
                            Free
                        </div>
                        @endif
                        <a href="{{ route('courses.details', $course->slug ?? $course->c_id) }}" class="course-btn">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center" style="padding: 40px;">
            <p style="color: #666; font-size: 16px;">No courses available at the moment. Please check back later.</p>
        </div>
        @endif
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