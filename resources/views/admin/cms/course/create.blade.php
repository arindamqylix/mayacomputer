@extends('admin.layouts.base')
@section('title', 'Add Course')
@section('content')

<!-- <div class="row mt-3">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Course</h4>
        </div>
    </div>
</div> -->

<div class="row mt-3">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Course Form
                <a href="{{ route('course.list') }}" class="btn btn-success btn-sm float-right">View All</a>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('store.course') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <label>Course Short Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="course_short_name" required>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Course Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="course_full_name" required>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Course Price <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="course_price" required>
                        </div>

                        <div class="col-lg-6 mb-2">
                            <label>Course Duration <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="course_duration" required>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@push('custom-script')

@endpush

