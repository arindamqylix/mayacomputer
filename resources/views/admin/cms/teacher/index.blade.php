@extends('admin.layouts.base')
@section('title', 'Director List')
@push('custom-css')
    <style type="text/css">
        .director-img {
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
                Director List
                <span class="float-right" style="float:right">
                    <a href="{{ route('add_director') }}">
                        <button class="btn btn-success btn-sm"> Add Director</button>
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
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($directors as $director)
                                <tr>
                                    <td>{{ $director->id }}</td>
                                    <td>
                                        @if($director->image)
                                            <img src="{{ asset('storage/'.$director->image) }}" alt="Director Image" class="director-img">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $director->name }}</td>
                                    <td>{{ $director->designation }}</td>
                                    <td>
                                        <a href="{{ route('edit_director', $director->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('delete_director', $director->id) }}" class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this director?')">Delete</a>
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
