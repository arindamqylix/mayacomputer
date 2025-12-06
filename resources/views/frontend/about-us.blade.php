@extends('frontend.layouts.master')
@section('title','About Us')
@section('content')
@php
    $aboutSections = DB::table('cms_about_us')->where('status', 1)->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
@endphp

<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title">About Us</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- About Us Sections Start -->
@forelse($aboutSections as $key => $section)
    @if($section->section == 'vision' && $section->video_url)
        <!-- Vision Section with Video -->
        <div class="rs-vision sec-spacer @if($key % 2 == 1) sec-color @endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mobile-mb-50">
                        <div class="vision-img rs-animation-hover">
                            @if($section->image)
                                <img src="{{ asset($section->image) }}" alt="{{ $section->title }}"/>
                            @else
                                <img src="{{asset('frontend/images/about/vision.jpg')}}" alt="{{ $section->title }}"/>
                            @endif
                            <a class="popup-youtube rs-animation-fade" href="{{ $section->video_url }}" title="Video Icon">
                            </a>
                            <div class="overly-border"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="abt-title">
                            <h2>{{ $section->title }}</h2>
                        </div>
                        <div class="vision-desc">
                            @if($section->description)
                                {!! $section->description !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Regular Section -->
        <div class="rs-history sec-spacer @if($key % 2 == 1) sec-color @endif">
            <div class="container">
                <div class="row">
                    @if($key % 2 == 0)
                        <!-- Image Left -->
                        <div class="col-lg-6 col-md-12 rs-vertical-bottom mobile-mb-50">
                            @if($section->image)
                                <img src="{{ asset($section->image) }}" alt="{{ $section->title }}"/>
                            @else
                                <img src="{{asset('frontend/images/about/history.jpg')}}" alt="{{ $section->title }}"/>
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="abt-title">
                                <h2>{{ $section->title }}</h2>
                            </div>
                            <div class="about-desc">
                                @if($section->description)
                                    {!! $section->description !!}
                                @endif
                            </div>
                        </div>
                    @else
                        <!-- Image Right -->
                        <div class="col-lg-6 col-md-12 mobile-mb-50">
                            <div class="abt-title">
                                <h2>{{ $section->title }}</h2>
                            </div>
                            <div class="about-desc">
                                @if($section->description)
                                    {!! $section->description !!}
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            @if($section->image)
                                <img src="{{ asset($section->image) }}" alt="{{ $section->title }}"/>
                            @else
                                <img src="{{asset('frontend/images/about/history.jpg')}}" alt="{{ $section->title }}"/>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@empty
    <!-- Default Content if no sections found -->
    <div class="rs-history sec-spacer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p>No about us sections found.</p>
                </div>
            </div>
        </div>
    </div>
@endforelse
<!-- About Us Sections End -->

	


@endsection