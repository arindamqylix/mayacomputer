@php
	$data = DB::table('site_settings')->where('id','1')->first();
@endphp

<!-- Footer Start -->
        <footer id="rs-footer" class="bg3 rs-footer">
			<div class="container">
				<!-- Footer Address -->
				<div>
					<div class="row footer-contact-desc">
						<div class="col-md-4">
							<div class="contact-inner">
								<i class="fa fa-map-marker"></i>
								<h4 class="contact-title">Address</h4>
								<p class="contact-desc">
									Register Office K-40/B, First Floor, New Govindpura Extension, Delhi-110051
								</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="contact-inner">
								<i class="fa fa-phone"></i>
								<h4 class="contact-title">Phone Number</h4>
								<p class="contact-desc">
									+918825148127<br>
								</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="contact-inner">
								<i class="fa fa-map-marker"></i>
								<h4 class="contact-title">Email Address</h4>
								<p class="contact-desc">
									mccsiswar@gmail.com<br>
								</p>
							</div>
						</div>
					</div>					
				</div>
			</div>
			
			<!-- Footer Top -->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">
                            <div class="about-widget">
                                <img src="{{asset($data->site_logo)}}" alt="Footer Logo">
                                <p>
                                    Maya Computer Center Pvt. Ltd. is an ISO 9001:2015 certified company which is recognized by JAS-ANZ and registered under the Company Act 2013, Ministry of Company Affairs, and Government of India with Certificate identity number (CIN) is U74999BR2017PTC036132.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <h5 class="footer-title">RECENT POSTS</h5>
                            <div class="recent-post-widget">
                                <div class="post-item">
                                    <div class="post-date">
                                        <span>28</span>
                                        <span>June</span>
                                    </div>
                                    <div class="post-desc">
                                        <h5 class="post-title"><a href="#">While the lovely valley team work</a></h5>
                                        <span class="post-category">Keyword Analysis</span>
                                    </div>
                                </div>
                                <div class="post-item">
                                    <div class="post-date">
                                        <span>28</span>
                                        <span>June</span>
                                    </div>
                                    <div class="post-desc">
                                        <h5 class="post-title"><a href="#">I must explain to you how all this idea</a></h5>
                                        <span class="post-category">Spoken English</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <h5 class="footer-title">OUR SITEMAP</h5>
                            <ul class="sitemap-widget">
                                <li class="active"><a href="{{url('/')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Home</a></li>
                                <li ><a href="{{route('aboutus')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>About</a></li>
                                <li><a href="{{route('gallery')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Gallery</a></li>
                                <li><a href="{{route('contact')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Contact Us</a></li> 
                                <li><a href="{{route('paymentTerms')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Terms & Conditions</a></li> 
                                <li><a href="{{route('paymentRefunds')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Privacy Policy</a></li> 
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <h5 class="footer-title">NEWSLETTER</h5>
                            <p>Sign Up to Our Newsletter to Get Latest Updates &amp; Services</p>
                            <form class="news-form">
                                <input type="text" class="form-input" placeholder="Enter Your Email">
                                <button type="submit" class="form-button"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="footer-share">
                        <ul>
                            <!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>     -->
                        </ul>
                    </div>                                
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="copyright">
                        <p>© 2025 <a href="{{url('/')}}">Maya Computer Center PVT LTD</a>. All Rights Reserved.</p>
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