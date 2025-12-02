@extends('frontend.layouts.master')
@section('title','Gallery')
@section('content')
<!-- Breadcrumbs Start -->
		<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
		    <div class="breadcrumbs-inner">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-12 text-center">
		                    <h1 class="page-title">OUR GALLERY</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
		                        <li>Gallery</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- Breadcrumbs End -->

		<!-- Gallery Start -->
        <div class="rs-gallery sec-spacer">
            <div class="container">
            	<!-- <div class="sec-title-2 mb-50 text-center">
            	    <h2>GALLERY (3 COLUMNS)</h2>      
            		<p>Considering primary motivation for the generation of narratives is a useful concept</p>
            	</div> -->
            	
                <div class="row">
                    @php
                        $gallery = DB::table('cms_gallery')->get();
                    @endphp

                    @foreach ($gallery as $val)
                        <div class="col-lg-4 col-md-6">
                            <div class="gallery-item">
                                <img src="{{asset($val->file)}}" alt="Gallery Image" />
                                <!-- <div class="gallery-desc">
                                    <h3><a href="#">University Practical Lab</a></h3>
                                    <p>The students of the department study <br>tour each year different</p>
                                    <a class="image-popup" href="images/gallery/4.jpg" title="University Practical Lab">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    @endforeach
            	</div>
        	   
            </div>
        </div>
        <!-- Gallery End -->
@endsection