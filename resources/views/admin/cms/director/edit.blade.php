@extends('admin.layouts.base')
@section('title', 'Edit Director')
@section('content')
<div class="row mt-3">
    <div class="col-lg-6">
        <form action="{{ route('update_director',$director->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header bg-secondary text-white font-weight-bold">
                    Edit Director
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $director->name }}" required>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control" value="{{ $director->designation }}">
                    </div> --}}
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control">{{ $director->description }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept=".jpg,.png,.jpeg">
                        @if($director->image)
                            <div class="mt-2">
                                <img src="{{ asset('director/'.$director->image) }}" width="120">
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label>Type <span class="text-danger">*</span></label>
                        <select name="type" id="" class="form-control">
                            <option value="">-- Type --</option>
                            <option value="Director" @if($director->type == 'Director') selected @endif>Director</option>
                            <option value="Teacher" @if($director->type == 'Teacher') selected @endif>Teacher</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer bg-light text-right">
                    <a href="{{ route('director_list') }}" class="btn btn-dark btn-sm">View All</a>
                    <button type="submit" class="btn btn-success btn-sm">Update</button>
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
