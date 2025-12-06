@extends('admin.layouts.base')
@section('title', 'Pages List')
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
                Pages List
                <span class="float-right" style="float:right">
                    <a href="{{ route('pages.create') }}">
                        <button class="btn btn-success btn-sm"> Add Page</button>
                    </a>
                </span>
            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
                    <thead>
                        <tr class="table_main_row">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>
                                    @if($page->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($page->created_at)
                                        {{ \Carbon\Carbon::parse($page->created_at)->format('d M Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('pages.destroy', $page->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this page?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No pages found.</td>
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

