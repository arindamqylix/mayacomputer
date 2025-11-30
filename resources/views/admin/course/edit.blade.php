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
                <form method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- Short Name -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Short Name</label>
                            <input type="text" class="form-control" name="course_short_name" value="{{ $data->c_short_name }}">
                        </div>

                        <!-- Full Name -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Full Name</label>
                            <input type="text" class="form-control" name="course_full_name" value="{{ $data->c_full_name }}" id="course_full_name">
                        </div>

						<input type="text" name="slug" id="course_slug" value="{{ $data->slug }}">

                        <!-- Price -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Price</label>
                            <input type="text" class="form-control" name="course_price" value="{{ $data->c_price }}">
                        </div>

                        <!-- Duration -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Duration</label>
                            <input type="text" class="form-control" name="course_duration" value="{{ $data->c_duration }}">
                        </div>

                        <!-- Category -->
                        <div class="col-lg-6 mb-2">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="category_name" value="{{ $data->category_name }}">
                        </div>

                        <!-- Description -->
                        <div class="col-lg-12 mb-2">
                            <label>Description</label>
                            <textarea name="description" rows="3" class="form-control">{{ $data->description }}</textarea>
                        </div>

                        <!-- File Upload -->
                        <div class="col-lg-6 mb-2">
                            <label>Course Image / PDF / Banner</label>
                            <input type="file" class="form-control" name="file">
                            @if($data->file)
                                <p class="mt-1">Current File: <a href="{{ asset($data->file) }}" target="_blank">View</a></p>
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
                                @if(!empty($data->information))
                                    @foreach(json_decode($data->information) as $info)
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
                                @if(!empty($data->course_syllabus))
                                    @foreach(json_decode($data->course_syllabus) as $syll)
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

});
</script>
@endsection
