@extends('admin.layouts.base')
@section('title', 'About Us Sections')
@push('custom-css')
<style type="text/css">
    .table_main_row th {
        text-align: center;
    }
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                About Us Sections
                <span class="float-right" style="float:right">
                    <a href="{{ route('about_us.create') }}">
                        <button class="btn btn-success btn-sm"> Add Section</button>
                    </a>
                </span>
            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
                    <thead>
                        <tr class="table_main_row">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Section</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aboutSections as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>
                                    @if($section->image)
                                        <img src="{{ asset($section->image) }}" alt="{{ $section->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $section->title }}</td>
                                <td>
                                    @if($section->section)
                                        <span class="badge bg-info">{{ ucfirst($section->section) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $section->sort_order }}</td>
                                <td>
                                    @if($section->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('about_us.edit', $section->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('about_us.destroy', $section->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this section?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No sections found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
@endpush

