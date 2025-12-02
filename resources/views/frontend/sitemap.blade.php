@extends('frontend.layouts.master')
@section('title','Sitemap')
@section('content')
@php
	$data = DB::table('site_settings')->where('id','1')->first();
	$courses = DB::table('course')->select('c_full_name', 'slug')->get();
	$downloads = DB::table('cms_downloads')->select('download_name', 'slug')->get();
@endphp
<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title">Sitemap</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>Sitemap</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Sitemap Section Start -->
<div class="contact-page-section sec-spacer">
    <div class="container">
        <div class="sitemap-content" style="font-family: Arial, sans-serif; line-height: 1.8; color: #333;">
            <div class="row">
                <!-- Main Pages -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="sitemap-section">
                        <h3 style="color: #0066cc; border-bottom: 2px solid #0066cc; padding-bottom: 10px; margin-bottom: 15px;">
                            <i class="fa fa-home"></i> Main Pages
                        </h3>
                        <ul style="list-style: none; padding-left: 0;">
                            <li style="padding: 5px 0;"><a href="{{ url('/') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #0066cc; margin-right: 8px;"></i>Home</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/about-us') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #0066cc; margin-right: 8px;"></i>About Us</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/director') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #0066cc; margin-right: 8px;"></i>Director</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/teacher') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #0066cc; margin-right: 8px;"></i>Teachers</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/courses') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #0066cc; margin-right: 8px;"></i>Courses</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/gallery') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #0066cc; margin-right: 8px;"></i>Gallery</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/contact') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #0066cc; margin-right: 8px;"></i>Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Verification -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="sitemap-section">
                        <h3 style="color: #28a745; border-bottom: 2px solid #28a745; padding-bottom: 10px; margin-bottom: 15px;">
                            <i class="fa fa-check-circle"></i> Verification
                        </h3>
                        <ul style="list-style: none; padding-left: 0;">
                            <li style="padding: 5px 0;"><a href="{{ url('/verification/registration') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #28a745; margin-right: 8px;"></i>Registration Verification</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/verification/icard') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #28a745; margin-right: 8px;"></i>I-Card Verification</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/verification/result') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #28a745; margin-right: 8px;"></i>Result Verification</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/verification/certificate') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #28a745; margin-right: 8px;"></i>Certificate Verification</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/verification/typing') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #28a745; margin-right: 8px;"></i>Typing Verification</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Downloads -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="sitemap-section">
                        <h3 style="color: #dc3545; border-bottom: 2px solid #dc3545; padding-bottom: 10px; margin-bottom: 15px;">
                            <i class="fa fa-download"></i> Downloads
                        </h3>
                        <ul style="list-style: none; padding-left: 0;">
                            <li style="padding: 5px 0;"><a href="{{ url('/downloads/admission-form') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #dc3545; margin-right: 8px;"></i>Admission Form</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/downloads/company-certificate') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #dc3545; margin-right: 8px;"></i>Company Certificate</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/downloads/pan-card') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #dc3545; margin-right: 8px;"></i>PAN Card</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/downloads/udyam-registration') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #dc3545; margin-right: 8px;"></i>Udyam Registration</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/downloads/startup-india') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #dc3545; margin-right: 8px;"></i>Startup India</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/downloads/iso-certificate') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #dc3545; margin-right: 8px;"></i>ISO Certificate</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/downloads/trademark') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #dc3545; margin-right: 8px;"></i>Trademark</a></li>
                            @foreach($downloads as $download)
                            <li style="padding: 5px 0;"><a href="{{ url('/downloads/' . $download->slug) }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #dc3545; margin-right: 8px;"></i>{{ $download->download_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Courses -->
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="sitemap-section">
                        <h3 style="color: #fd7e14; border-bottom: 2px solid #fd7e14; padding-bottom: 10px; margin-bottom: 15px;">
                            <i class="fa fa-graduation-cap"></i> Courses
                        </h3>
                        <ul style="list-style: none; padding-left: 0;">
                            @foreach($courses as $course)
                            <li style="padding: 5px 0;"><a href="{{ url('/courses-details/' . $course->slug) }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #fd7e14; margin-right: 8px;"></i>{{ $course->c_full_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Legal & Policies -->
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="sitemap-section">
                        <h3 style="color: #6c757d; border-bottom: 2px solid #6c757d; padding-bottom: 10px; margin-bottom: 15px;">
                            <i class="fa fa-file-text"></i> Legal & Policies
                        </h3>
                        <ul style="list-style: none; padding-left: 0;">
                            <li style="padding: 5px 0;"><a href="{{ url('/terms-and-conditions') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #6c757d; margin-right: 8px;"></i>Terms and Conditions</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/refund-policy') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #6c757d; margin-right: 8px;"></i>Refund Policy</a></li>
                            <li style="padding: 5px 0;"><a href="{{ url('/disclaimer') }}" style="color: #333; text-decoration: none;"><i class="fa fa-angle-right" style="color: #6c757d; margin-right: 8px;"></i>Disclaimer</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- XML Sitemap Link -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p style="color: #666; font-size: 14px;">
                        <i class="fa fa-sitemap"></i> For search engines: 
                        <a href="{{ url('/sitemap.xml') }}" style="color: #0066cc;" target="_blank">sitemap.xml</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sitemap Section End -->

<style>
    .sitemap-section ul li a:hover {
        color: #0066cc !important;
        text-decoration: underline !important;
    }
    .sitemap-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        height: 100%;
    }
</style>
@endsection
