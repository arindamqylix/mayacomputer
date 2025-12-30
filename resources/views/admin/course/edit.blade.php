@extends('admin.layouts.base')
@section('title', 'Edit Course')
@section('content')

<div class="row mt-3">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Course</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header form-section-heading">
                <h5>Course Update Form</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('edit_course', $data->c_id) }}">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label>Course Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="course_full_name" value="{{ $data->c_full_name ?? '' }}" required>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Course Price <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="course_price" value="{{ $data->c_price ?? '' }}" required>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Course Duration <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="course_duration" value="{{ $data->c_duration ?? '' }}" required>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fa fa-save"></i> Update Course
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
