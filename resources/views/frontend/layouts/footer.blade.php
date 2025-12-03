@php
	$data = DB::table('site_settings')->where('id','1')->first();
@endphp

<style>
.footer-contact-box {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    border-radius: 20px;
    padding: 40px 20px;
    margin-top: -80px;
    position: relative;
    z-index: 10;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}
.footer-contact-box .contact-inner {
    text-align: center;
    padding: 15px 10px;
}
.footer-contact-box .contact-inner i {
    font-size: 28px;
    color: #e94560;
    margin-bottom: 12px;
    display: inline-block;
    width: 60px;
    height: 60px;
    line-height: 60px;
    background: rgba(233, 69, 96, 0.15);
    border-radius: 50%;
    transition: all 0.3s ease;
}
.footer-contact-box .contact-inner:hover i {
    background: #e94560;
    color: #fff;
    transform: scale(1.1);
}
.footer-contact-box .contact-title {
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}
.footer-contact-box .contact-desc {
    color: #b0b0b0;
    font-size: 13px;
    line-height: 1.5;
    margin: 0;
}
.footer-contact-box .col-lg-3:not(:last-child) .contact-inner {
    border-right: 1px solid rgba(255, 255, 255, 0.1);
}
@media (max-width: 991px) {
    .footer-contact-box .col-lg-3:not(:last-child) .contact-inner {
        border-right: none;
    }
    .footer-contact-box .col-lg-3 {
        margin-bottom: 20px;
    }
}
@media (max-width: 768px) {
    .footer-contact-box {
        margin-top: 30px;
        padding: 30px 15px;
    }
}
</style>

<!-- Newsletter Section Start -->
<style>
.newsletter-section {
    background: linear-gradient(135deg, #d00226 0%, #d40e22 50%, #d00226 100%);
    padding: 50px 0;
    margin-bottom: 0;
}
.newsletter-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 30px;
}
.newsletter-content {
    max-width: 500px;
}
.newsletter-content .newsletter-title {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 10px;
}
.newsletter-content .newsletter-title i {
    font-size: 28px;
    color: #ffffff;
    transform: rotate(-25deg);
}
.newsletter-content .newsletter-title h3 {
    color: #ffffff;
    font-size: 26px;
    font-weight: 700;
    margin: 0;
}
.newsletter-content p {
    color: #ffffff;
    font-size: 15px;
    margin: 0;
    opacity: 0.95;
}
.newsletter-form {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}
.newsletter-form .email-input {
    width: 320px;
    height: 55px;
    padding: 0 25px;
    border: none;
    border-radius: 50px;
    font-size: 15px;
    color: #333;
    outline: none;
    background: #ffffff;
}
.newsletter-form .email-input::placeholder {
    color: #888;
}
.newsletter-form .subscribe-btn {
    height: 55px;
    padding: 0 35px;
    background: #1e3a5f;
    color: #ffffff;
    border: none;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
}
.newsletter-form .subscribe-btn:hover {
    background: #152a45;
    transform: translateY(-2px);
}
.newsletter-form .subscribe-btn i {
    font-size: 14px;
}
@media (max-width: 991px) {
    .newsletter-wrapper {
        justify-content: center;
        text-align: center;
    }
    .newsletter-content .newsletter-title {
        justify-content: center;
    }
    .newsletter-form {
        justify-content: center;
    }
}
@media (max-width: 576px) {
    .newsletter-form .email-input {
        width: 100%;
    }
    .newsletter-form {
        width: 100%;
        flex-direction: column;
    }
    .newsletter-form .subscribe-btn {
        width: 100%;
        justify-content: center;
    }
}
/* Remove gap between newsletter and footer */
.newsletter-section {
    margin-bottom: 0 !important;
}
#rs-footer.rs-footer,
footer#rs-footer,
.rs-footer.bg3 {
    margin-top: 0 !important;
    padding-top: 50px !important;
}
#rs-footer.rs-footer .footer-top {
    padding-top: 0;
}
section.newsletter-section + footer#rs-footer {
    margin-top: 0 !important;
}
</style>

<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-wrapper">
            <div class="newsletter-content">
                <div class="newsletter-title">
                    <i class="fa fa-paper-plane"></i>
                    <h3>Subscribe to Our Newsletter</h3>
                </div>
                <p>Get latest updates on courses, offers, and career tips directly in your inbox.</p>
            </div>
            <form class="newsletter-form" action="#" method="POST">
                @csrf
                <input type="email" name="email" class="email-input" placeholder="Enter your email address" required>
                <button type="submit" class="subscribe-btn">Subscribe <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>
    </div>
</section>
<!-- Newsletter Section End -->

<!-- Footer Start -->
        <footer id="rs-footer" class="bg3 rs-footer">
			
			
			<style>
			.footer-new-style .footer-title-new {
				color: #ffffff;
				font-size: 20px;
				font-weight: 600;
				margin-bottom: 25px;
				position: relative;
			}
			.footer-new-style .info-link-list {
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.footer-new-style .info-link-list li {
				margin-bottom: 12px;
			}
			.footer-new-style .info-link-list li a {
				color: #a8b8d0;
				text-decoration: none;
				display: flex;
				align-items: center;
				transition: all 0.3s ease;
			}
			.footer-new-style .info-link-list li a:hover {
				color: #ff6b35;
				padding-left: 5px;
			}
			.footer-new-style .info-link-list li a .icon-box {
				width: 28px;
				height: 28px;
				background: rgba(255, 107, 53, 0.2);
				border-radius: 6px;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				margin-right: 12px;
			}
			.footer-new-style .info-link-list li a .icon-box i {
				color: #ff6b35;
				font-size: 12px;
			}
			.footer-new-style .contact-info-list {
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.footer-new-style .contact-info-list li {
				display: flex;
				align-items: flex-start;
				margin-bottom: 20px;
			}
			.footer-new-style .contact-info-list li .icon-box-lg {
				width: 45px;
				height: 45px;
				border-radius: 10px;
				display: inline-flex;
				align-items: center;
				justify-content: center;
				margin-right: 15px;
				flex-shrink: 0;
			}
			.footer-new-style .contact-info-list li .icon-box-lg.orange {
				background: linear-gradient(135deg, #ff6b35, #ff8f35);
			}
			.footer-new-style .contact-info-list li .icon-box-lg.blue {
				background: linear-gradient(135deg, #3a5a8c, #4a6a9c);
			}
			.footer-new-style .contact-info-list li .icon-box-lg i {
				color: #ffffff;
				font-size: 18px;
			}
			.footer-new-style .contact-info-list li .info-text {
				color: #a8b8d0;
				font-size: 14px;
				line-height: 1.5;
			}
			.footer-new-style .contact-info-list li .info-text a {
				color: #a8b8d0;
				text-decoration: none;
				transition: color 0.3s ease;
			}
			.footer-new-style .contact-info-list li .info-text a:hover {
				color: #ff6b35;
			}
			</style>

			<!-- Footer Top -->
            <div class="footer-top footer-new-style">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="about-widget">
                                <img src="{{asset($data->site_logo)}}" alt="Footer Logo">
                                <p style="text-align: justify;">
                                    Maya Computer Center Pvt. Ltd. is an ISO 9001:2015 certified company which is recognized by JAS-ANZ and registered under the Company Act 2013, Ministry of Company Affairs, and Government of India.
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <h5 class="footer-title-new">Information Link</h5>
                            <ul class="info-link-list">
                                <li><a href="{{url('/')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>Home</a></li>
                                <li><a href="{{route('aboutus')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>About Us</a></li>
                                <li><a href="{{route('courses')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>Courses</a></li>
                                <li><a href="{{route('gallery')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>Gallery</a></li>
                                <li><a href="{{route('contact')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <h5 class="footer-title-new">Quick Links</h5>
                            <ul class="info-link-list">
                                <li><a href="{{route('paymentTerms')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>Terms & Conditions</a></li>
                                <li><a href="{{route('paymentRefunds')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>Privacy Policy</a></li>
                                <li><a href="{{route('disclaimer')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>Disclaimer</a></li>
                                <li><a href="{{route('sitemap')}}"><span class="icon-box"><i class="fa fa-angle-right"></i></span>Sitemap</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <h5 class="footer-title-new">Location</h5>
                            <ul class="contact-info-list">
                                <li>
                                    <span class="icon-box-lg orange"><i class="fa fa-map-marker"></i></span>
                                    <span class="info-text">Corporate Office
                                        Siswar, Phulparas, Madhubani, Bihar - 847409</span>
                                </li>
                                <li>
                                    <span class="icon-box-lg orange"><i class="fa fa-map-marker"></i></span>
                                    <span class="info-text">Registered Office
                                        K-40/B, First Floor, New Govindpura Extension, Delhi-110051</span>
                                </li>
                                <li>
                                    <span class="icon-box-lg blue"><i class="fa fa-phone"></i></span>
                                    <span class="info-text"><a href="tel:{{$data->phone ?? ''}}">{{$data->phone ?? '+918825148127'}}</a></span>
                                </li>
                                <li>
                                    <span class="icon-box-lg blue"><i class="fa fa-envelope"></i></span>
                                    <span class="info-text"><a href="mailto:{{$data->email ?? ''}}">{{$data->email ?? 'mccsiswar@gmail.com'}}</a></span>
                                </li>
                                
                            </ul>
                        </div>
                        
                    </div>
                    <div class="footer-share">
                        <ul>
                            <!-- Social icons can be added here -->
                        </ul>
                    </div>                                
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="copyright">
                        <p>© <?php date('Y');?> <a href="{{url('/')}}">Maya Computer Center Private Limited</a>. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp">
            <i class="fa fa-angle-up"></i>
        </div>
		
		<!-- Canvas Menu start -->
        <nav class="right_menu_togle">
        	<div class="close-btn"><span id="nav-close" class="text-center">x</span></div>
            <div class="canvas-logo">
                <a href="{{url('/')}}"><img src="{{asset($data->site_logo)}}" alt="logo"></a>
            </div>
        	<ul class="sidebarnav_menu list-unstyled main-menu">
                <!--Home Menu Start-->
                <li class="current-menu-item "><a href="#">Home</a>
                </li>
                <!--Home Menu End-->
                
                <!--About Menu Start-->
                <li class="menu-item-has-children"><a href="{{route('aboutus')}}">About Us</a>
                </li>
                <!--About Menu End-->
                
                <!--Courses Menu Star-->
               
                <!--Courses Menu End-->
                
                <!--Events Menu Star-->
               
                <!--Events Menu End-->

                <li><a href="{{route('gallery')}}">Gallery<span class="icon"></span></a></li>
                <li><a href="{{route('contact')}}">Contact<span class="icon"></span></a></li>
        	</ul>
            <div class="search-wrap"> 
                <label class="screen-reader-text">Search for:</label> 
                <input type="search" placeholder="Search..." name="s" class="search-input" value=""> 
                <button type="submit" value="Search"><i class="fa fa-search"></i></button>
            </div>
        </nav>
        <!-- Canvas Menu end -->
        
        <!-- Search Modal Start -->
        <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
        	<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true" class="fa fa-close"></span>
	        </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-block clearfix">
                        <form>
                            <div class="form-group">
                                <input class="form-control" placeholder="eg: Computer Technology" type="text">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Search Modal End --> 





        
        <!-- modernizr js -->
        <script src="{{asset('frontend/js/modernizr-2.8.3.min.js')}}"></script>
        <!-- jquery latest version -->
        <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
        <!-- bootstrap js -->
        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
        <!-- owl.carousel js -->
        <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
		<!-- slick.min js -->
        <script src="{{asset('frontend/js/slick.min.js')}}"></script>
        <!-- isotope.pkgd.min js -->
        <script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
        <!-- imagesloaded.pkgd.min js -->
        <script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
        <!-- wow js -->
        <script src="{{asset('frontend/js/wow.min.js')}}"></script>
        <!-- counter top js -->
        <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
        <!-- magnific popup -->
        <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
        <!-- rsmenu js -->
        <script src="{{asset('frontend/js/rsmenu-main.js')}}"></script>
        <!-- plugins js -->
        <script src="{{asset('frontend/js/plugins.js')}}"></script>
		 <!-- main js -->
        <script src="{{asset('frontend/js/main.js')}}"></script>