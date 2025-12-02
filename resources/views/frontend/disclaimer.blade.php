@extends('frontend.layouts.master')
@section('title','Disclaimer')
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
		                    <h1 class="page-title">Disclaimer</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
		                        <li>Disclaimer</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div><!-- .breadcrumbs-inner end -->
		</div>
		<!-- Breadcrumbs End -->
		
		<!-- Contact Section Start -->
		<div class="contact-page-section sec-spacer">
        	<div class="container">
        		<section class="payment-terms" style="font-family:Arial, sans-serif; line-height:1.6; color:#333;">
                    <h2 style="color:#2a7ae2;">General Disclaimer</h2>
                    <p>
                        The information provided on this website is for general informational purposes only. 
                        While we strive to keep the information up-to-date and accurate, <strong>Maya Computer</strong> 
                        makes no representations or warranties of any kind, express or implied, about the completeness, 
                        accuracy, reliability, suitability, or availability with respect to the website or the information, 
                        products, services, or related graphics contained on the website for any purpose.
                    </p>

                    <h3 style="color:#2a7ae2; margin-top:30px;">Educational Services Disclaimer</h3>
                    <ol>
                        <li>
                            <strong>Course Content &amp; Curriculum</strong><br>
                            The courses offered by Maya Computer are designed to provide quality computer education and skill development. 
                            However, we do not guarantee specific employment outcomes or career advancement as a result of completing our courses. 
                            Success depends on individual effort, market conditions, and other external factors.
                        </li>

                        <li>
                            <strong>Certification &amp; Recognition</strong><br>
                            Certificates issued by Maya Computer are proof of course completion and skill assessment conducted by our institution. 
                            The recognition and acceptance of these certificates by employers or other educational institutions is at their sole discretion.
                        </li>

                        <li>
                            <strong>Franchise Operations</strong><br>
                            Maya Computer operates through authorized franchise centers. While we maintain quality standards across all centers, 
                            individual franchise operations are managed independently by their respective owners. 
                            Any disputes arising at the franchise level should first be addressed with the concerned franchise center.
                        </li>
                    </ol>

                    <h3 style="color:#2a7ae2; margin-top:30px;">Website Usage Disclaimer</h3>
                    <ol>
                        <li>
                            <strong>External Links</strong><br>
                            This website may contain links to external websites that are not provided or maintained by Maya Computer. 
                            We do not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.
                        </li>

                        <li>
                            <strong>Technical Errors</strong><br>
                            We make every effort to ensure this website functions properly. However, we do not accept responsibility for 
                            any temporary unavailability of the website due to technical issues beyond our control.
                        </li>

                        <li>
                            <strong>Verification Services</strong><br>
                            The online verification services provided for registration, I-Card, results, and certificates are for 
                            informational purposes. For official verification, please contact our head office directly.
                        </li>
                    </ol>

                    <h3 style="color:#2a7ae2; margin-top:30px;">Limitation of Liability</h3>
                    <p>
                        In no event shall Maya Computer, its directors, employees, partners, agents, suppliers, or affiliates be liable 
                        for any indirect, incidental, special, consequential, or punitive damages, including without limitation, 
                        loss of profits, data, use, goodwill, or other intangible losses, resulting from:
                    </p>
                    <ul>
                        <li>Your access to or use of or inability to access or use the website or services</li>
                        <li>Any conduct or content of any third party on the website</li>
                        <li>Any content obtained from the website</li>
                        <li>Unauthorized access, use, or alteration of your transmissions or content</li>
                    </ul>

                    <h3 style="color:#2a7ae2; margin-top:30px;">Changes to Disclaimer</h3>
                    <p>
                        Maya Computer reserves the right to modify this disclaimer at any time without prior notice. 
                        It is your responsibility to review this page periodically for any changes. 
                        Your continued use of the website following the posting of any changes constitutes acceptance of those changes.
                    </p>

                    <h3 style="color:#2a7ae2; margin-top:30px;">Contact Information</h3>
                    <p>
                        If you have any questions about this Disclaimer, please contact us:<br>
                        <strong>Maya Computer</strong><br>
                        Email: <a href="mailto:mccsiswar@gmail.com">mccsiswar@gmail.com</a><br>
                        Phone: +91 8825148127
                    </p>

                    <p style="margin-top:30px; font-style:italic; color:#666;">
                        <strong>Last Updated:</strong> {{ date('F Y') }}
                    </p>
                </section>
        	</div>
        </div>
        <!-- Contact Section End -->  
@endsection