@extends('admin.layouts.base')
@section('title', 'Course Category List')
@push('custom-css')
    <style type="text/css">
        .status-badge {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
        }
        .status-active {
            background-color: #28a745;
            color: white;
        }
        .status-inactive {
            background-color: #dc3545;
            color: white;
        }
    </style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Course Category List
                <span class="float-right" style="float:right">
                    <a href="{{ route('add.course.category') }}">
                        <button class="btn btn-success btn-sm"> Add Category</button>
                    </a>
                </span>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
                        <thead>
                            <tr class="table_main_row">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if($category->status == 1)
                                            <span class="status-badge status-active">Active</span>
                                        @else
                                            <span class="status-badge status-inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at ? \Carbon\Carbon::parse($category->created_at)->format('d M Y') : '-' }}</td>
                                    <td>
                                        <a href="{{ route('edit.course.category', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('delete.course.category', $category->id) }}" class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
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






