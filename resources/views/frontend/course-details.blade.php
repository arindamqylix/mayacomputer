@extends('frontend.layouts.master')
@section('title', $data->c_full_name ?? 'Course Details')
@push('custom-css')
<style>
    .course-details-section {
        padding: 80px 0;
        background: #f9f9f9;
    }
    .course-main-img {
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        min-height: 400px;
        background: linear-gradient(135deg, #000055 0%, #000088 50%, #1a1a5e 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .course-main-img img {
        width: 100%;
        height: auto;
        min-height: 400px;
        object-fit: cover;
    }
    .no-image-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 400px;
        color: rgba(255, 255, 255, 0.7);
        background: rgba(0, 0, 0, 0.2);
    }
    .no-image-placeholder i {
        font-size: 80px;
        margin-bottom: 15px;
        opacity: 0.6;
    }
    .no-image-placeholder span {
        font-size: 18px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .course-info-card {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.08);
    }
    .course-title-main {
        font-size: 28px;
        font-weight: 700;
        color: #222;
        margin-bottom: 20px;
    }
    .course-meta-info {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #eee;
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .meta-item i {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #000055 0%, #000088 100%);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }
    .meta-item .meta-content span {
        display: block;
        font-size: 12px;
        color: #888;
    }
    .meta-item .meta-content strong {
        font-size: 16px;
        color: #333;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    .info-grid-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 3px solid #ff6b35;
    }
    .info-grid-item span {
        font-weight: 600;
        color: #333;
        margin-right: 8px;
    }
    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #222;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #000055;
        display: inline-block;
    }
    .course-description {
        line-height: 1.8;
        color: #555;
    }
    .course-description p {
        margin-bottom: 15px;
    }
    /* Syllabus Accordion */
    .syllabus-accordion .card {
        border: none;
        margin-bottom: 10px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .syllabus-accordion .card-header {
        background: #fff;
        padding: 0;
        border: none;
    }
    .syllabus-accordion .acdn-title {
        width: 100%;
        padding: 18px 25px;
        background: #f8f9fa;
        border: none;
        text-align: left;
        font-size: 16px;
        font-weight: 600;
        color: #333;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }
    .syllabus-accordion .acdn-title:hover,
    .syllabus-accordion .acdn-title[aria-expanded="true"] {
        background: linear-gradient(135deg, #000055 0%, #000088 100%);
        color: #fff;
    }
    .syllabus-accordion .acdn-title strong {
        color: #ff6b35;
        margin-right: 10px;
    }
    .syllabus-accordion .acdn-title[aria-expanded="true"] strong {
        color: #fff;
    }
    .syllabus-accordion .card-body {
        padding: 20px 25px;
        background: #fff;
        line-height: 1.8;
        color: #555;
    }
    /* Sidebar */
    .sidebar-card {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.08);
    }
    .sidebar-title {
        font-size: 18px;
        font-weight: 700;
        color: #222;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #ff6b35;
    }
    .price-box {
        text-align: center;
        padding: 30px;
        background: linear-gradient(135deg, #000055 0%, #000088 100%);
        border-radius: 15px;
        color: #fff;
    }
    .price-box .price {
        font-size: 42px;
        font-weight: 700;
    }
    .price-box .price-label {
        font-size: 14px;
        opacity: 0.8;
    }
    .btn-enroll {
        display: block;
        width: 100%;
        padding: 15px;
        background: #ff6b35;
        color: #fff;
        text-align: center;
        border-radius: 30px;
        font-weight: 700;
        font-size: 16px;
        text-decoration: none;
        margin-top: 20px;
        transition: all 0.3s ease;
    }
    .btn-enroll:hover {
        background: #e55a27;
        color: #fff;
        transform: translateY(-2px);
    }
    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .category-list li {
        margin-bottom: 10px;
    }
    .category-list li a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        background: #f8f9fa;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .category-list li a:hover {
        background: linear-gradient(135deg, #000055 0%, #000088 100%);
        color: #fff;
    }
    .category-list li a i {
        margin-right: 10px;
        color: #ff6b35;
    }
    .category-list li a:hover i {
        color: #fff;
    }
    .related-course {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }
    .related-course:last-child {
        border-bottom: none;
    }
    .related-course .course-thumb {
        width: 80px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .related-course .course-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .related-course .course-info h5 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .related-course .course-info h5 a {
        color: #333;
        text-decoration: none;
    }
    .related-course .course-info h5 a:hover {
        color: #000055;
    }
    .related-course .course-info .price {
        font-size: 14px;
        color: #ff6b35;
        font-weight: 700;
    }
    @media (max-width: 991px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush
@section('content')

<!-- Breadcrumbs Start -->
<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
    <div class="breadcrumbs-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="page-title">{{ $data->c_full_name ?? 'Course Details' }}</h1>
                    <ul>
                        <li>
                            <a class="active" href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <a class="active" href="{{ route('courses') }}">Courses</a>
                        </li>
                        <li>{{ $data->c_short_name ?? $data->c_full_name ?? '' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Course Details Section Start -->
<div class="course-details-section">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                @if(!$data)
                    <div class="course-info-card">
                        <h3>Course not found</h3>
                        <p>The course you're looking for doesn't exist.</p>
                        <a href="{{ route('courses') }}" class="btn-explore">Back to Courses</a>
                    </div>
                @else
                <!-- Course Image -->
                <div class="course-main-img">
                    @if($data->file)
                        <img src="{{ asset($data->file) }}" alt="{{ $data->c_full_name }}">
                    @else
                        <div class="no-image-placeholder">
                            <i class="fa fa-image"></i>
                            <span>No Image Available</span>
                        </div>
                    @endif
                </div>

                <!-- Course Info Card -->
                <div class="course-info-card">
                    <h1 class="course-title-main">{{ $data->c_full_name ?? '' }}</h1>
                    
                    <div class="course-meta-info">
                        @if($data->c_duration)
                        <div class="meta-item">
                            <i class="fa fa-clock-o"></i>
                            <div class="meta-content">
                                <span>Duration</span>
                                <strong>{{ $data->c_duration }}</strong>
                            </div>
                        </div>
                        @endif
                        
                        @if($data->c_price)
                        <div class="meta-item">
                            <i class="fa fa-inr"></i>
                            <div class="meta-content">
                                <span>Course Fee</span>
                                <strong>₹{{ number_format($data->c_price) }}</strong>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($data->course_eligibility) && $data->course_eligibility)
                        <div class="meta-item">
                            <i class="fa fa-graduation-cap"></i>
                            <div class="meta-content">
                                <span>Eligibility</span>
                                <strong>{{ $data->course_eligibility }}</strong>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($data->category_name))
                        <div class="meta-item">
                            <i class="fa fa-folder-open"></i>
                            <div class="meta-content">
                                <span>Category</span>
                                <strong>{{ $data->category_name }}</strong>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Basic Information -->
                    @php
                        $information = json_decode($data->information, true);
                    @endphp
                    @if(!empty($information))
                    <h3 class="section-title">Basic Information</h3>
                    <div class="info-grid mb-4">
                        @foreach($information as $info)
                        <div class="info-grid-item">
                            <span>{{ $info['title'] ?? '' }}:</span>
                            {{ $info['value'] ?? '' }}
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Course Description -->
                @if($data->description)
                <div class="course-info-card">
                    <h3 class="section-title">Course Description</h3>
                    <div class="course-description">
                        {!! $data->description !!}
                    </div>
                </div>
                @endif

                <!-- Course Syllabus -->
                @php
                    $syllabus = json_decode($data->course_syllabus, true);
                @endphp
                @if(!empty($syllabus))
                <div class="course-info-card">
                    <h3 class="section-title">Course Syllabus</h3>
                    <div id="syllabusAccordion" class="syllabus-accordion">
                        @foreach($syllabus as $index => $item)
                        <div class="card">
                            <div class="card-header" id="syllabusHeading{{ $index }}">
                                <h3 class="acdn-title" data-bs-toggle="collapse"
                                    data-bs-target="#syllabusCollapse{{ $index }}"
                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-controls="syllabusCollapse{{ $index }}">
                                    <strong>Module {{ $index + 1 }}:</strong>
                                    <span>{{ $item['name'] ?? '' }}</span>
                                </h3>
                            </div>
                            <div id="syllabusCollapse{{ $index }}"
                                class="collapse {{ $index == 0 ? 'show' : '' }}"
                                aria-labelledby="syllabusHeading{{ $index }}"
                                data-bs-parent="#syllabusAccordion">
                                <div class="card-body">
                                    {!! $item['desc'] ?? '' !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Price & Enroll -->
                <div class="sidebar-card">
                    <div class="price-box">
                        <div class="price-label">Course Fee</div>
                        <div class="price">₹{{ number_format($data->c_price ?? 0) }}</div>
                    </div>
                    <a href="{{ route('contact') }}" class="btn-enroll">
                        <i class="fa fa-graduation-cap"></i> Enroll Now
                    </a>
                </div>

                <!-- Course Categories -->
                @if(isset($allCategories) && $allCategories->count() > 0)
                <div class="sidebar-card">
                    <h4 class="sidebar-title">Course Categories</h4>
                    <ul class="category-list">
                        @foreach($allCategories as $cat)
                        @php
                            $catCount = DB::table('cms_course')->where('category_id', $cat->id)->count();
                        @endphp
                        <li>
                            <a href="{{ route('courses.category', $cat->slug) }}">
                                <i class="fa fa-angle-right"></i>
                                {{ $cat->name }}
                                <span class="ms-auto">({{ $catCount }})</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Related Courses -->
                @if(isset($relatedCourses) && count($relatedCourses) > 0)
                <div class="sidebar-card">
                    <h4 class="sidebar-title">Related Courses</h4>
                    @foreach($relatedCourses as $related)
                    <div class="related-course">
                        <div class="course-thumb">
                            @if($related->file)
                                <img src="{{ asset($related->file) }}" alt="{{ $related->c_full_name }}">
                            @else
                                <img src="{{ asset('frontend/images/courses/default.jpg') }}" alt="{{ $related->c_full_name }}">
                            @endif
                        </div>
                        <div class="course-info">
                            <h5>
                                <a href="{{ route('courses.details', $related->slug ?? $related->c_id) }}">
                                    {{ Str::limit($related->c_full_name ?? $related->c_short_name, 40) }}
                                </a>
                            </h5>
                            @if($related->c_price)
                                <span class="price">₹{{ number_format($related->c_price) }}</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Course Details Section End -->

@endsection
