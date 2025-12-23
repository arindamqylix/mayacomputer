@extends('admin.layouts.base')
@section('title', 'Edit Syllabus')
@push('custom-css')
<style type="text/css">
	.form-header {
		background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
		border: none;
		padding: 1.5rem;
		border-radius: 0.5rem 0.5rem 0 0;
	}
	
	.form-header h4 {
		color: white;
		margin: 0;
		font-weight: 600;
		font-size: 1.5rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}
	
	.modern-card {
		border: none;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		border-radius: 0.5rem;
		overflow: hidden;
	}
	
	.type-option {
		display: none;
	}
	
	.type-option.active {
		display: block;
	}
	
	.current-file {
		margin-top: 0.5rem;
		padding: 0.5rem;
		background: #f8f9fa;
		border-radius: 0.25rem;
	}
</style>
@endpush

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="modern-card">
				<div class="form-header">
					<h4>
						<i class="fas fa-edit"></i>
						Edit Course Syllabus
					</h4>
				</div>
				<div class="card-body">
					<form method="POST" enctype="multipart/form-data" action="{{ route('admin.syllabus.update', $syllabus->cs_id) }}">
						@csrf
						
						<div class="row">
							<div class="col-md-6 mb-3">
								<label>Course <span class="text-danger">*</span></label>
								<select name="course_id" class="form-control" required>
									<option value="">Select Course</option>
									@foreach($courses as $course)
										<option value="{{ $course->c_id }}" {{ $syllabus->cs_FK_of_course_id == $course->c_id ? 'selected' : '' }}>
											{{ $course->c_full_name ?? $course->c_short_name }}
										</option>
									@endforeach
								</select>
								@error('course_id')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<div class="col-md-6 mb-3">
								<label>Type <span class="text-danger">*</span></label>
								<select name="type" id="typeSelect" class="form-control" required>
									<option value="">Select Type</option>
									<option value="video" {{ $syllabus->cs_type == 'video' ? 'selected' : '' }}>Video (YouTube)</option>
									<option value="pdf" {{ $syllabus->cs_type == 'pdf' ? 'selected' : '' }}>PDF</option>
								</select>
								@error('type')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<div class="col-md-12 mb-3">
								<label>Title <span class="text-danger">*</span></label>
								<input type="text" name="title" class="form-control" value="{{ $syllabus->cs_title }}" placeholder="Enter syllabus title" required>
								@error('title')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<div class="col-md-12 mb-3">
								<label>Description</label>
								<textarea name="description" class="form-control" rows="3" placeholder="Enter description (optional)">{{ $syllabus->cs_description }}</textarea>
								@error('description')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<!-- Video URL Option -->
							<div class="col-md-12 mb-3 type-option {{ $syllabus->cs_type == 'video' ? 'active' : '' }}" id="videoOption">
								<label>YouTube Video URL <span class="text-danger">*</span></label>
								<input type="url" name="video_url" class="form-control" value="{{ $syllabus->cs_video_url }}" placeholder="Enter YouTube video URL (e.g., https://www.youtube.com/watch?v=VIDEO_ID)">
								<small class="text-muted">You can paste any YouTube URL (watch, embed, or youtu.be format)</small>
								@error('video_url')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<!-- PDF File Option -->
							<div class="col-md-12 mb-3 type-option {{ $syllabus->cs_type == 'pdf' ? 'active' : '' }}" id="pdfOption">
								<label>PDF File</label>
								@if($syllabus->cs_pdf_file)
									<div class="current-file">
										<i class="fas fa-file-pdf text-danger"></i> 
										<a href="{{ asset($syllabus->cs_pdf_file) }}" target="_blank">{{ basename($syllabus->cs_pdf_file) }}</a>
										<small class="text-muted">(Current file - upload new file to replace)</small>
									</div>
								@endif
								<input type="file" name="pdf_file" class="form-control mt-2" accept=".pdf">
								<small class="text-muted">Maximum file size: 10MB. Leave empty to keep current file.</small>
								@error('pdf_file')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<div class="col-md-6 mb-3">
								<label>Display Order</label>
								<input type="number" name="order" class="form-control" value="{{ $syllabus->cs_order }}" min="0">
								<small class="text-muted">Lower numbers appear first</small>
								@error('order')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<div class="col-md-6 mb-3">
								<label>Status <span class="text-danger">*</span></label>
								<select name="status" class="form-control" required>
									<option value="active" {{ $syllabus->cs_status == 'active' ? 'selected' : '' }}>Active</option>
									<option value="inactive" {{ $syllabus->cs_status == 'inactive' ? 'selected' : '' }}>Inactive</option>
								</select>
								@error('status')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">
									<i class="fas fa-save"></i> Update Syllabus
								</button>
								<a href="{{ route('admin.syllabus.index') }}" class="btn btn-secondary">
									<i class="fas fa-times"></i> Cancel
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('custom-script')
<script>
	$(document).ready(function() {
		// Show appropriate fields based on current type
		var currentType = $('#typeSelect').val();
		if (currentType) {
			$('#' + currentType + 'Option').addClass('active');
		}
		
		$('#typeSelect').on('change', function() {
			var type = $(this).val();
			$('.type-option').removeClass('active');
			
			if (type == 'video') {
				$('#videoOption').addClass('active');
				$('#videoOption input').prop('required', true);
				$('#pdfOption input').prop('required', false);
			} else if (type == 'pdf') {
				$('#pdfOption').addClass('active');
				$('#pdfOption input').prop('required', false); // Not required on edit if file exists
			} else {
				$('#videoOption input').prop('required', false);
				$('#pdfOption input').prop('required', false);
			}
		});
	});
</script>
@endpush

