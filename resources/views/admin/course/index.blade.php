@extends('admin.layouts.base')
@section('title', 'Course List')
@push('custom-css')
    <style type="text/css">
        .course-img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Course List
                <span class="float-right" style="float:right">
                    <a href="{{ route('add.course') }}">
                        <button class="btn btn-success btn-sm"> Add Course</button>
                    </a>
                </span>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
                        <thead>
                            <tr class="table_main_row">
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Short Name</th>
                                <th>Duration</th>
                                <th>Price</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course as $item)
                                <tr>
                                    <td>{{ $item->c_id }}</td>
                                    <td>{{ $item->c_full_name }}</td>
                                    <td>{{ $item->c_short_name }}</td>
                                    <td>{{ $item->c_duration ?? 'N/A' }}</td>
                                    <td>{{ $item->c_price ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($item->description ?? '', 50) }}</td>
                                    <td>
                                        <a href="{{ route('edit_course', $item->c_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('delete_course', $item->c_id) }}" class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')

@endpush
