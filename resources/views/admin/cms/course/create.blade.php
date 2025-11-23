@extends('admin.layouts.base')
@section('title', 'Add Course')
@push('custom-css')
<style type="text/css">
    /* Custom styling if needed */
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-8">
        <form action="{{ route('store.course') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="card">
                <div class="card-header bg-secondary text-white font-weight-bold" >
                    Add Course
                </div>
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group mb-3">
                                <label>Course Name <span class="text-danger">*</span></label>
                                <input type="text" name="course_name" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Course Image</label>
                                <input type="file" name="course_image" class="form-control" accept=".jpg,.png,.jpeg,.gif">
                            </div>

                            <div class="form-group mb-3">
                                <label>Course Duration</label>
                                <input type="text" name="course_duration" class="form-control" placeholder="e.g. 6 Months">
                            </div>

                            <div class="form-group mb-3">
                                <label>Course Details</label>
                                <textarea name="course_details" rows="5" class="form-control" placeholder="Enter course details"></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Buttons moved to footer --}}
                <div class="card-footer bg-light text-right">
                    <a href="{{ route('course_list') }}" class="btn btn-dark btn-sm">View All</a>
                    <button type="submit" class="btn btn-success btn-sm" id="save_btn" accesskey="s">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
@push('custom-js')

@endpush
