@extends('admin.layouts.base')
@section('title', 'Add Course Category')
@push('custom-css')
<style>
</style>
@endpush
@section('content')

<div class="row mt-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Add Course Category
                <a href="{{ route('course.category.list') }}" class="btn btn-success btn-sm float-right">View All</a>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('store.course.category') }}">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12 mb-3">
                            <label>Category Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" id="category_name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                   name="slug" id="category_slug" value="{{ old('slug') }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Auto-generated from name. You can edit if needed.</small>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-lg-4 mx-auto mt-3">
                            <button type="submit" class="btn w-100 btn-secondary">
                                <i class="fa fa-save"></i> Save Category
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
        $('#category_name').on('keyup', function() {
            let text = $(this).val();
            let slug = text.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
            $('#category_slug').val(slug);
        });
    });
</script>
@endsection

@push('custom-js')

@endpush












