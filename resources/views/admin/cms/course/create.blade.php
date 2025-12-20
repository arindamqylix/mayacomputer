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
                            <label>Course Eligibility</label>
                            <input type="text" class="form-control" name="course_eligibility" placeholder="e.g., Matric, Non Matric, 10+2">
                        </div>

                        <div class="col-lg-4 mb-2">
                            <label>Course Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label>Course Image / File</label>
                            <input type="file" class="form-control" name="file">
                        </div>

                        <div class="col-lg-12 mb-2">
                            <label>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
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
        let syllRowCount = 0;
        $("#addSyll").on("click", function () {
            syllRowCount++;
            const textareaId = 'syll_desc_' + syllRowCount;
            $("#syllTable tbody").append(`
                <tr>
                    <td><input type="text" class="form-control" name="syll_name[]" required></td>
                    <td><textarea class="form-control ckeditor-syllabus" name="syll_desc[]" id="${textareaId}" rows="3" required></textarea></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                </tr>
            `);
            
            // Initialize CKEditor for the new textarea
            CKEDITOR.replace(textareaId, {
                height: 150,
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                    { name: 'links', items: ['Link', 'Unlink'] },
                    { name: 'insert', items: ['Image', 'Table'] },
                    { name: 'styles', items: ['Format'] },
                    { name: 'tools', items: ['Source'] }
                ]
            });
        });

        // Remove Row Event
        $(document).on("click", ".remove-row", function () {
            const row = $(this).closest("tr");
            // Destroy CKEditor instance if it exists
            const textarea = row.find('textarea.ckeditor-syllabus');
            if (textarea.length) {
                const editorId = textarea.attr('id');
                if (editorId && CKEDITOR.instances[editorId]) {
                    CKEDITOR.instances[editorId].destroy();
                }
            }
            row.remove();
        });

		$('#course_full_name').on('keyup', function() {
			let text = $(this).val();
			let slug = text.toLowerCase()
						.replace(/[^a-z0-9\s-]/g, '')  // remove invalid chars
						.replace(/\s+/g, '-')          // replace spaces with -
						.replace(/-+/g, '-');          // remove multiple -
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

@push('custom-script')

@endpush

