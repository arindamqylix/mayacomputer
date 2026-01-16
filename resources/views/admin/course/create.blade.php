@extends('admin.layouts.base')
@section('title', 'Add Course')
@push('custom-css')
<style>
    .remove-row {
        cursor: pointer;
        color: red;
        font-weight: bold;
    }
</style>
@endpush
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
                <form method="POST" enctype="multipart/form-data" action="{{ route('store.course') }}">
                    @csrf
                    <div class="row">

                        {{-- Course Basic --}}
                        <div class="col-lg-6 mb-2">
                            <label>Course Short Name</label>
                            <input type="text" class="form-control" name="course_short_name">
                        </div>

                       <div class="col-lg-6 mb-2">
							<label>Course Full Name</label>
							<input type="text" class="form-control" name="course_full_name" id="course_full_name">
						</div>

						<input type="hidden" name="slug" id="course_slug">


                        <div class="col-lg-4 mb-2">
                            <label>Course Price</label>
                            <input type="text" class="form-control" name="course_price">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Course Duration</label>
                            <input type="text" class="form-control" name="course_duration">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Course Category</label>
                            <input type="text" class="form-control" name="category_name">
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label>Course Image / File</label>
                            <input type="file" class="form-control" name="file">
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                        </div>

                        {{-- Information Repeater --}}
                        <div class="col-lg-12">
                            <label><strong>Course Information</strong></label>
                            <table class="table table-bordered" id="infoTable">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Value</th>
                                        <th width="50">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary btn-sm mt-2" id="addInfo">+ Add Row</button>
                        </div>

                        {{-- Syllabus Repeater --}}
                        <div class="col-lg-12 mt-3">
                            <label><strong>Course Syllabus</strong></label>
                            <table class="table table-bordered" id="syllTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th width="50">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary btn-sm mt-2" id="addSyll">+ Add Row</button>
                        </div>

                        <div class="col-lg-4 mx-auto mt-4">
                            <button type="submit" class="btn w-100 btn-secondary">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        // Information Repeater
        $("#addInfo").on("click", function () {
			// alert(1);
            $("#infoTable tbody").append(`
                <tr>
                    <td><input type="text" class="form-control" name="info_title[]" required></td>
                    <td><input type="text" class="form-control" name="info_value[]" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                </tr>
            `);
        });

        // Syllabus Repeater
        $("#addSyll").on("click", function () {
            $("#syllTable tbody").append(`
                <tr>
                    <td><input type="text" class="form-control" name="syll_name[]" required></td>
                    <td><textarea class="form-control" name="syll_desc[]" rows="1" required></textarea></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                </tr>
            `);
        });

        // Remove Row Event
        $(document).on("click", ".remove-row", function () {
            $(this).closest("tr").remove();
        });

		$('#course_full_name').on('keyup', function() {
			let text = $(this).val();
			let slug = text.toLowerCase()
						.replace(/[^a-z0-9\s-]/g, '')  // remove invalid chars
						.replace(/\s+/g, '-')          // replace spaces with -
						.replace(/-+/g, '-');          // remove multiple -
			$('#course_slug').val(slug);
		});

    });
</script>
@endsection

@push('custom-js')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endpush

