@extends('admin.layouts.base')
@section('title', 'WhatsApp Templates')
@push('custom-css')
    <style type="text/css">
        
    </style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                WhatsApp Templates
                <span class='float-right' style='float:right'>
                    <a href="{{ route('admin.whatsapp_templates.create') }}">
                        <button class="btn btn-success btn-sm">Add New Template</button>
                    </a>
                </span>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
                        <thead>
                            <tr class="table_main_row">
                                <th>#ID</th>
                                <th>Template Name</th>
                                <th>Message Preview</th>
                                <th>Variables</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates as $template)
                                <tr>
                                    <td>{{ $template->id }}</td>
                                    <td><strong>{{ $template->template_name }}</strong></td>
                                    <td>{{ strlen($template->message) > 100 ? substr($template->message, 0, 100) . '...' : $template->message }}</td>
                                    <td>
                                        @if($template->variables)
                                            @php
                                                $vars = json_decode($template->variables, true);
                                            @endphp
                                            @if(is_array($vars))
                                                @foreach($vars as $var)
                                                    <span class="badge bg-info">{{ $var }}</span>
                                                @endforeach
                                            @endif
                                        @else
                                            <span class="text-muted">No variables</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($template->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($template->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.whatsapp_templates.edit', $template->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.whatsapp_templates.destroy', $template->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this template?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </button>
                                        </form>
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

