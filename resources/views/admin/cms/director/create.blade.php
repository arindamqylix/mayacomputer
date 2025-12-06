@extends('admin.layouts.base')
@section('title', 'Add Director')
@section('content')
<div class="row mt-3">
    <div class="col-lg-6">
        <form method="POST" action="{{ route('store_director') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Add Director
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control">
                    </div> --}}
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg">
                    </div>
                    <div class="form-group mb-3">
                        <label>Type <span class="text-danger">*</span></label>
                        <select name="type" id="" class="form-control">
                            <option value="">-- Type --</option>
                            <option value="Director">Director</option>
                            <option value="Teacher">Teacher</option>
                            <option value="About Us">About Us</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer bg-light text-right">
                    <a href="{{ route('director_list') }}" class="btn btn-dark btn-sm">View All</a>
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection

@push('custom-js')

@endpush
