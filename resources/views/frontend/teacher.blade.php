@extends('frontend.layouts.master')
@section('title','Teacher')
@section('content')
@php
	$teachers = DB::table('cms_directors')->where('type', 'Teacher')->get();
@endphp

<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title">Teacher</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>Teacher</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Teachers Section Start -->
@forelse($teachers as $key => $teacher)
<div class="rs-history sec-spacer @if($key % 2 == 1) sec-color @endif">
    <div class="container">
        <div class="row">
            @if($key % 2 == 0)
            <div class="col-lg-6 col-md-12 rs-vertical-bottom mobile-mb-50">
                <a href="#">
                    @if($teacher->image)
                        <img src="{{ asset('director/'.$teacher->image) }}" alt="{{ $teacher->name }}"/>
                    @else
                        <img src="{{ asset('frontend/images/about/history.jpg') }}" alt="{{ $teacher->name }}"/>
                    @endif
                </a>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="abt-title">
                    <h2>{{ $teacher->name }}</h2>
                </div>
                <div class="about-desc">
                    @if($teacher->description)
                        {!! $teacher->description !!}
                    @endif
                </div>
            </div>
            @else
            <div class="col-lg-6 col-md-12 mobile-mb-50">
                <div class="abt-title">
                    <h2>{{ $teacher->name }}</h2>
                </div>
                <div class="about-desc">
                    @if($teacher->description)
                        {!! $teacher->description !!}
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <a href="#">
                    @if($teacher->image)
                        <img src="{{ asset('director/'.$teacher->image) }}" alt="{{ $teacher->name }}"/>
                    @else
                        <img src="{{ asset('frontend/images/about/history.jpg') }}" alt="{{ $teacher->name }}"/>
                    @endif
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@empty
<div class="rs-history sec-spacer">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p>No teachers found.</p>
            </div>
        </div>
    </div>
</div>
@endforelse
<!-- Teachers Section End -->

@endsection