@extends('admin.layouts.base')
@section('title', 'Edit Course')
@push('custom-css')
<style type="text/css">
    /* Custom styling if needed */
    .preview-img {
        max-width: 150px;
        margin-top: 10px;
        border-radius: 5px;
    }
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-8">
        <form action="{{ route('update.course',$course->id) }}" id="update_course_frm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Edit Course
                </div>
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group mb-3">
                                <label>Course Name <span class="text-danger">*</span></label>
                                <input type="text" name="course_name" class="form-control" value="{{ $course->course_name }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Course Image</label>
                                <input type="file" name="course_image" class="form-control" accept=".jpg,.png,.jpeg,.gif">

                                {{-- Show existing image if available --}}
                                @if($course->course_image)
                                    <div class="mt-2">
                                        <label class="text-muted">Current Image:</label><br>
                                        <img src="{{ asset('storage/'.$course->course_image) }}" alt="Course Image" class="preview-img">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label>Course Duration</label>
                                <input type="text" name="course_duration" class="form-control" value="{{ $course->course_duration }}" placeholder="e.g. 6 Months">
                            </div>

                            <div class="form-group mb-3">
                                <label>Course Details</label>
                                <textarea name="course_details" rows="5" class="form-control" placeholder="Enter course details">{{ $course->course_details }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Buttons moved to footer --}}
                <div class="card-footer bg-light text-right">
                    <a href="{{ route('course_list') }}" class="btn btn-dark btn-sm">View All</a>
                    <button type="submit" class="btn btn-success btn-sm" id="update_btn" accesskey="s">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
@push('custom-js')

@endpush
