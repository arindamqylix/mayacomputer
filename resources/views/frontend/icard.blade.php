@extends('frontend.layouts.master')
@section('title','I-Card Verification')
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
		                    <h1 class="page-title">I-Card Verification</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
		                        <li>I-Card Verification</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div><!-- .breadcrumbs-inner end -->
		</div>
		<!-- Breadcrumbs End -->
		
@endsection