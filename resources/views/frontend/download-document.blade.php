@extends('frontend.layouts.master')
@section('title','Download Doocument')
@section('content')
<!-- Breadcrumbs Start -->
		<div class="rs-breadcrumbs bg7 breadcrumbs-overlay" style="background-image: url({{ breadcrumb_image() }});">
		    <div class="breadcrumbs-inner">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-12 text-center">
		                    <h1 class="page-title">{{$data->download_name??''}}</h1>
		                    <ul>
		                        <li>
		                            <a class="active" href="{{url('/')}}">Home</a>
		                        </li>
		                        <li>{{$data->download_name??''}}</li>
		                    </ul>
		                </div>
		            </div>
		        </div>
		    </div><!-- .breadcrumbs-inner end -->
		</div>
		<!-- Breadcrumbs End -->
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card shadow-sm border-0">
                <div class="card-body p-3">

                    <iframe src="{{ asset($data->file) }}" 
                        width="100%" 
                        height="800px"
                        style="border: none;">
                    </iframe>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
