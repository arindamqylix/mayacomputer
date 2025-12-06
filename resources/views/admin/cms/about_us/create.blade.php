@extends('admin.layouts.base')
@section('title', 'Add About Us Section')
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
<div class="row mt-3">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Add About Us Section
                <a href="{{ route('about_us.list') }}" class="btn btn-success btn-sm float-right">View All</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('about_us.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label>Section Type</label>
                            <select name="section" class="form-control">
                                <option value="">-- Select Section --</option>
                                <option value="history" {{ old('section') == 'history' ? 'selected' : '' }}>History</option>
                                <option value="mission" {{ old('section') == 'mission' ? 'selected' : '' }}>Mission</option>
                                <option value="vision" {{ old('section') == 'vision' ? 'selected' : '' }}>Vision</option>
                            </select>
                            <small class="text-muted">Optional: Helps organize sections</small>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" id="description" rows="10" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg">
                            <small class="text-muted">Recommended size: 800x600px</small>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label>Video URL (for Vision section)</label>
                            <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/watch?v=...">
                            <small class="text-muted">YouTube video URL (optional)</small>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-right">
                        <a href="{{ route('about_us.list') }}" class="btn btn-dark btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-success btn-sm">Save Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        height: 400
    });
</script>
@endsection
@push('custom-js')
@endpush

