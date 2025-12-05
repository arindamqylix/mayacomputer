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
                                <th>Image</th>
                                <th>Course Name</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Eligibility</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->c_id }}</td>
                                    <td>
                                        @if($course->file)
                                            <img style="width: 74px;height: 71px;" src="{{ asset($course->file) }}" alt="Course Image" class="course-img">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $course->c_full_name ?? $course->c_short_name }}</td>
                                    <td>{{ $course->c_price }}</td>
                                    <td>{{ $course->c_duration }}</td>
                                    <td>{{ $course->course_eligibility ?? '-' }}</td>
                                    <td>{{ $course->category_name ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('edit.course', $course->c_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('delete.course', $course->c_id) }}" class="btn btn-danger btn-sm"
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
