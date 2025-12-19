@extends('admin.layouts.base')
@section('title', 'Edit Banner')
@push('custom-css')
<style type="text/css">
		
</style>
@endpush
@section('content')
<div class="row mt-3">
	<div class="col-lg-6">
		<form id='update_frm' method="post" action="{{ route('edit_banner', $banner->id) }}" enctype="multipart/form-data">
			@csrf
			<div class="card">
				<div class="card-header bg-secondary text-white font-weight-bold">
					Edit Banner
				</div>
				<div class="card-body"> 
					<div class='row'>
						<div class="col-md-12">
							<div class="form-group mb-3">
                                <label>Banner Image</label><br>
                                <input class="form-control" type="file" name="file" accept=".jpg,.png,.jpeg">
                                <small class="text-muted">Leave empty to keep current image</small>

                                {{-- Show existing file if available --}}
                                @if($banner->file)
                                    <div class="mt-2">
                                        <label class="text-muted">Current Image:</label><br>
                                        <img src="{{ asset($banner->file) }}" alt="Banner Image" class="preview-img" style="max-width: 300px; height: auto; border-radius: 5px;">
                                    </div>
                                @endif
                            </div>

							<div class="form-group mb-3">
								<label>Title (Badge Text)</label>
								<input type="text" name="title" class="form-control" placeholder="e.g., WELCOME TO EXCELLENCE" value="{{ old('title', $banner->title ?? '') }}">
								<small class="text-muted">Small badge/tag text displayed at the top of banner</small>
							</div>

							<div class="form-group mb-3">
								<label>Heading (Main Text)</label>
								<input type="text" name="header" class="form-control" placeholder="e.g., METHOD MEDIA COMPUTER ACADEMY PRIVATE LIMITED" value="{{ old('header', $banner->header ?? '') }}">
								<small class="text-muted">Large main heading text displayed on banner</small>
							</div>

							<div class="form-group mb-3">
								<label>Short Description</label>
								<textarea name="short_description" class="form-control" rows="3" placeholder="e.g., Transform your career with industry-leading computer education...">{{ old('short_description', $banner->short_description ?? '') }}</textarea>
								<small class="text-muted">Brief description text displayed below header</small>
							</div>

							<div class="form-group mb-3">
								<label>Button Name</label>
								<input type="text" name="button_name" class="form-control" placeholder="e.g., Explore Courses" value="{{ old('button_name', $banner->button_name ?? '') }}">
								<small class="text-muted">Text for the call-to-action button</small>
							</div>

							<div class="form-group mb-3">
								<label>Button URL</label>
								<input type="url" name="button_url" class="form-control" placeholder="e.g., https://example.com/courses" value="{{ old('button_url', $banner->button_url ?? '') }}">
								<small class="text-muted">Link URL when button is clicked</small>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label>Sort Order</label>
										<input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order ?? 0) }}" min="0">
										<small class="text-muted">Lower numbers appear first</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label>Status</label>
										<select name="status" class="form-control">
											<option value="1" {{ old('status', $banner->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
											<option value="0" {{ old('status', $banner->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				{{-- Buttons moved to footer --}}
				<div class="card-footer bg-light text-right">
					<a href="{{ route('all_banner') }}" class="btn btn-dark btn-sm">View All</a>
					<button type="submit" class="btn btn-success btn-sm" id="update_btn" accesskey="s">Update</button>
				</div>

			</div>
		</form>
	</div>
</div>
@endsection
@push('custom-js')

@endpush
