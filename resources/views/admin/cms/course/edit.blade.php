@extends('admin.layouts.base')
@section('title', 'Edit Course')
@push('custom-css')
<style>
    .remove-row { cursor:pointer; }
</style>
@endpush

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
                <form method="POST" enctype="multipart/form-data" action="{{ route('update.course', $course->c_id) }}">
                    @csrf

                    <div class="row">

                        <!-- Short Name -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Short Name</label>
                            <input type="text" class="form-control" name="course_short_name" value="{{ $course->c_short_name }}">
                        </div>

                        <!-- Full Name -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Full Name</label>
                            <input type="text" class="form-control" name="course_full_name" value="{{ $course->c_full_name }}" id="course_full_name">
                        </div>

						<input type="hidden" name="slug" id="course_slug" value="{{ $course->slug }}">

                        <!-- Price -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Price</label>
                            <input type="text" class="form-control" name="course_price" value="{{ $course->c_price }}">
                        </div>

                        <!-- Duration -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Duration</label>
                            <input type="text" class="form-control" name="course_duration" value="{{ $course->c_duration }}">
                        </div>

                        <!-- Category -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($course->category_id) && $course->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-lg-12 mb-2">
                            <label>Description</label>
                            <textarea name="description" id="description" rows="5" class="form-control">{{ $course->description }}</textarea>
                        </div>

                        <!-- File Upload -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Image / PDF / Banner</label>
                            <input type="file" class="form-control" name="file">
                            @if($course->file)
                                <p class="mt-1">Current File: <a href="{{ asset($course->file) }}" target="_blank">View</a></p>
                            @endif
                        </div>

                        <!-- Information Repeater -->
                        <div class="col-lg-12 mt-3">
                            <h6>Information</h6>
                            <table class="table table-bordered" id="infoTable">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Value</th>
                                    <th><button type="button" id="addInfo" class="btn btn-primary btn-sm">+</button></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($course->information))
                                    @foreach(json_decode($course->information) as $info)
                                        <tr>
                                            <td><input type="text" class="form-control" name="info_title[]" value="{{ $info->title }}"></td>
                                            <td><input type="text" class="form-control" name="info_value[]" value="{{ $info->value }}"></td>
                                            <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Syllabus Repeater -->
                        <div class="col-lg-12 mt-3">
                            <h6>Syllabus</h6>
                            <table class="table table-bordered" id="syllTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th><button type="button" id="addSyll" class="btn btn-primary btn-sm">+</button></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($course->course_syllabus))
                                    @foreach(json_decode($course->course_syllabus) as $syll)
                                        <tr>
                                            <td><input type="text" class="form-control" name="syll_name[]" value="{{ $syll->name }}"></td>
                                            <td><textarea class="form-control" name="syll_desc[]">{{ $syll->desc }}</textarea></td>
                                            <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Submit -->
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4 mt-3">
                            <button type="submit" class="btn btn-secondary w-100"><i class="fa fa-save"></i> Update Course</button>
                        </div>
                        <div class="col-lg-4"></div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
$(document).ready(function(){

    $("#addInfo").on("click", function(){
        $("#infoTable tbody").append(`
            <tr>
                <td><input type="text" class="form-control" name="info_title[]" required></td>
                <td><input type="text" class="form-control" name="info_value[]" required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
            </tr>
        `);
    });

    $("#addSyll").on("click", function(){
        $("#syllTable tbody").append(`
            <tr>
                <td><input type="text" class="form-control" name="syll_name[]" required></td>
                <td><textarea class="form-control" name="syll_desc[]" rows="1" required></textarea></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
            </tr>
        `);
    });

    $(document).on("click", ".remove-row", function(){
        $(this).closest("tr").remove();
    });

	$('#course_full_name').on('keyup', function() {
		let text = $(this).val();
		let slug = text.toLowerCase()
					.replace(/[^a-z0-9\s-]/g, '')  
					.replace(/\s+/g, '-')        
					.replace(/-+/g, '-');        
		$('#course_slug').val(slug);
	});

	// Initialize CKEditor for description
	CKEDITOR.replace('description', {
		height: 300,
		toolbar: [
			{ name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
			{ name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
			{ name: 'links', items: ['Link', 'Unlink'] },
			{ name: 'insert', items: ['Image', 'Table'] },
			{ name: 'styles', items: ['Format', 'FontSize'] },
			{ name: 'colors', items: ['TextColor', 'BGColor'] },
			{ name: 'tools', items: ['Maximize', 'Source'] }
		]
	});

});
</script>
@endsection
