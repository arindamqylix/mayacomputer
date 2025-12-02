@extends('frontend.layouts.master')
@section('title','Director')
@section('content')
@php
    $directors = DB::table('cms_directors')->where('type', 'Director')->get();
@endphp

<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title">Director</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{url('/')}}">Home</a>
                        </li>
                        <li>Director</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Directors Section Start -->
@forelse($directors as $key => $director)
<div class="rs-history sec-spacer @if($key % 2 == 1) sec-color @endif">
    <div class="container">
        <div class="row">
            @if($key % 2 == 0)
            <div class="col-lg-6 col-md-12 rs-vertical-bottom mobile-mb-50">
                <a href="#">
                    @if($director->image)
                        <img src="{{ asset('director/'.$director->image) }}" alt="{{ $director->name }}"/>
                    @else
                        <img src="{{ asset('frontend/images/about/history.jpg') }}" alt="{{ $director->name }}"/>
                    @endif
                </a>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="abt-title">
                    <h2>{{ $director->name }}</h2>
                </div>
                <div class="about-desc">
                    @if($director->description)
                        {!! $director->description !!}
                    @endif
                </div>
            </div>
            @else
            <div class="col-lg-6 col-md-12 mobile-mb-50">
                <div class="abt-title">
                    <h2>{{ $director->name }}</h2>
                </div>
                <div class="about-desc">
                    @if($director->description)
                        {!! $director->description !!}
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <a href="#">
                    @if($director->image)
                        <img src="{{ asset('director/'.$director->image) }}" alt="{{ $director->name }}"/>
                    @else
                        <img src="{{ asset('frontend/images/about/history.jpg') }}" alt="{{ $director->name }}"/>
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
                <p>No directors found.</p>
            </div>
        </div>
    </div>
</div>
@endforelse
<!-- Directors Section End -->

@endsection