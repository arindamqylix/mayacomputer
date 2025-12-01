@extends('frontend.layouts.master')
@section('title','Download Doocument')
@section('content')

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
