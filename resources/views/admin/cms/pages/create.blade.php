@extends('admin.layouts.base')
@section('title', 'Create Page')
@push('custom-css')
<style type="text/css">
    .form-section-heading {
        background: #6c757d;
        color: #fff;
        padding: 15px;
        font-weight: bold;
    }
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Create New Page
                <a href="{{ route('pages.list') }}" class="btn btn-success btn-sm float-right">View All</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pages.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label>Page Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required>
                            <small class="text-muted">URL-friendly version of the title (e.g., privacy-policy, terms-conditions)</small>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" rows="10" class="form-control">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                            <small class="text-muted">SEO meta title (optional)</small>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
                            <small class="text-muted">SEO meta description (optional)</small>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Meta Keywords</label>
                            <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords') }}">
                            <small class="text-muted">Comma-separated keywords (optional)</small>
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
                        <a href="{{ route('pages.list') }}" class="btn btn-dark btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-success btn-sm">Save Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        var title = this.value;
        var slug = title.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        document.getElementById('slug').value = slug;
    });

    // Initialize CKEditor
    CKEDITOR.replace('content', {
        height: 400
    });
</script>
@endsection
@push('custom-js')
@endpush

