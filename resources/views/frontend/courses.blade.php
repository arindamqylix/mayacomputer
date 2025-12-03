@extends('frontend.layouts.master')
@section('title', $category ? $category->name . ' Courses' : 'All Courses')

<style>
    .courses-page {
        padding: 80px 0;
        background: #f8fafc;
    }
    /* Header Section */
    .courses-header {
        text-align: center;
        margin-bottom: 50px;
    }
    .courses-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(0, 0, 85, 0.08);
        color: #000055;
        padding: 10px 24px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }
    .courses-badge i {
        font-size: 14px;
    }
    .courses-title {
        font-size: 42px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 8px;
    }
    .courses-title span {
        color: #d00226;
    }
    .title-line {
        width: 60px;
        height: 4px;
        background: #000055;
        margin: 20px auto;
        border-radius: 2px;
    }
    .courses-subtitle {
        font-size: 17px;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }
    /* Category Filter */
    .category-filter {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 50px;
    }
    .filter-btn {
        display: inline-block;
        padding: 12px 28px;
        background: #fff;
        color: #444;
        border: 2px solid #e8e8e8;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .filter-btn:hover {
        border-color: #d00226;
        color: #fff;
        background: #d00226;
    }
    .filter-btn.active {
        background: #000055;
        border-color: #000055;
        color: #fff;
    }
    /* Course Cards */
    .course-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06);
        transition: all 0.4s ease;
        margin-bottom: 30px;
        height: calc(100% - 30px);
        display: flex;
        flex-direction: column;
        position: relative;
    }
    .course-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 85, 0.15);
    }
    .course-card.featured {
        border: 2px solid #ff6b35;
    }
    .featured-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #ff6b35;
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 10;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .featured-badge i {
        font-size: 10px;
    }
    .course-image {
        position: relative;
        height: 200px;
        background: linear-gradient(135deg, #000055 0%, #000088 50%, #1a1a5e 100%);
        overflow: hidden;
    }
    .course-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.85;
        transition: all 0.5s ease;
    }
    .course-card:hover .course-image img {
        transform: scale(1.1);
        opacity: 1;
    }
    .category-tag {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #d00226;
        color: #fff;
        padding: 7px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .course-content {
        padding: 28px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .course-name {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 15px;
        line-height: 1.4;
    }
    .course-name a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s;
    }
    .course-name a:hover {
        color: #d00226;
    }
    .course-desc {
        color: #666;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 20px;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .course-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 18px;
        border-top: 1px solid #f0f0f0;
        margin-bottom: 20px;
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #666;
        font-size: 13px;
    }
    .meta-item i {
        color: #ff6b35;
        font-size: 14px;
    }
    .btn-explore {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 14px 20px;
        background: #000055;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .btn-explore:hover {
        background: #d00226;
        color: #fff;
        gap: 15px;
    }
    .btn-explore i {
        transition: transform 0.3s;
    }
    .btn-explore:hover i {
        transform: translateX(3px);
    }
    /* Price Tag */
    .price-display {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: #fff;
        color: #000055;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    /* No Courses */
    .no-courses {
        text-align: center;
        padding: 80px 30px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.06);
    }
    .no-courses i {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }
    .no-courses h4 {
        color: #333;
        font-size: 22px;
        margin-bottom: 10px;
    }
    .no-courses p {
        color: #888;
        font-size: 15px;
    }
    @media (max-width: 767px) {
        .courses-title {
            font-size: 28px;
        }
        .course-image {
            height: 180px;
        }
    }
</style>
@section('content')

<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title">{{ $category ? $category->name : 'Our Courses' }}</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <a class="active" href="{{ route('courses') }}">Courses</a>
                        </li>
                        @if($category)
                        <li>{{ $category->name }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Courses Section Start -->
<div class="courses-page">
    <div class="container">
        <!-- Header -->
        <div class="courses-header">
            <div class="courses-badge">
                <i class="fa fa-graduation-cap"></i> OUR COURSES
            </div>
            <h2 class="courses-title">Professional <span>Training Programs</span></h2>
            <div class="title-line"></div>
            <p class="courses-subtitle">
                Comprehensive training programs designed to transform beginners into industry-ready professionals
            </p>
        </div>

        <!-- Category Filter -->
        <div class="category-filter">
            <a href="{{ route('courses') }}" class="filter-btn {{ !$category ? 'active' : '' }}">All Courses</a>
            @foreach($categories as $cat)
            <a href="{{ route('courses.category', $cat->slug) }}" 
               class="filter-btn {{ $category && $category->id == $cat->id ? 'active' : '' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>

        <!-- Courses Grid -->
        @if($courses->count() > 0)
        <div class="row">
            @foreach($courses as $index => $course)
            <div class="col-lg-4 col-md-6">
                <div class="course-card {{ $index == 1 ? 'featured' : '' }}">
                    @if($index == 1)
                    <div class="featured-badge">
                        <i class="fa fa-star"></i> MOST POPULAR
                    </div>
                    @endif
                    
                    <div class="course-image">
                        @if($course->file)
                            <img src="{{ asset($course->file) }}" alt="{{ $course->c_full_name }}">
                        @else
                            <img src="{{ asset('frontend/images/courses/default.jpg') }}" alt="{{ $course->c_full_name }}">
                        @endif
                        
                        @php
                            $courseCat = DB::table('cms_course_category')->where('id', $course->category_id)->first();
                        @endphp
                        @if($courseCat)
                            <span class="category-tag">{{ $courseCat->name }}</span>
                        @endif
                        
                        @if($course->c_price)
                            <span class="price-display">₹{{ number_format($course->c_price) }}</span>
                        @endif
                    </div>
                    
                    <div class="course-content">
                        <h3 class="course-name">
                            <a href="{{ route('courses.details', $course->slug ?? $course->c_id) }}">
                                {{ $course->c_full_name ?? $course->c_short_name }}
                            </a>
                        </h3>
                        
                        @if($course->description)
                            <p class="course-desc">{{ Str::limit(strip_tags($course->description), 120) }}</p>
                        @else
                            <p class="course-desc">Learn industry-relevant skills with our comprehensive curriculum designed by experts.</p>
                        @endif
                        
                        <div class="course-meta">
                            <div class="meta-item">
                                <i class="fa fa-clock-o"></i>
                                <span>{{ $course->c_duration ?? '3-6 Months' }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa fa-user"></i>
                                <span>All Levels</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('courses.details', $course->slug ?? $course->c_id) }}" class="btn-explore">
                            <i class="fa fa-arrow-right"></i> Explore Course
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="no-courses">
            <i class="fa fa-graduation-cap"></i>
            <h4>No courses available</h4>
            <p>We're working on adding new courses. Please check back soon!</p>
        </div>
        @endif
    </div>
</div>
<!-- Courses Section End -->

@endsection
