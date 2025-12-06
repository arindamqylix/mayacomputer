@extends('frontend.layouts.master')
@section('title', $page->meta_title ?? $page->title)
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
                    <h1 class="page-title">{{ $page->title }}</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>{{ $page->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- .breadcrumbs-inner end -->
</div>
<!-- Breadcrumbs End -->

<!-- Page Content Section Start -->
<div class="contact-page-section sec-spacer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content-wrapper" style="font-family:Arial, sans-serif; line-height:1.6; color:#333;">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Content Section End -->

@if($page->meta_description || $page->meta_keywords)
@section('meta')
    @if($page->meta_description)
    <meta name="description" content="{{ $page->meta_description }}">
    @endif
    @if($page->meta_keywords)
    <meta name="keywords" content="{{ $page->meta_keywords }}">
    @endif
@endsection
@endif
@endsection

