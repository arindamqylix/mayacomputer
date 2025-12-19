@extends('admin.layouts.base')
@section('title', 'Edit WhatsApp Template')
@push('custom-css')
    <style type="text/css">
        .variable-hint {
            background: #f0f7ff;
            border-left: 4px solid #1e3a8a;
            padding: 10px;
            margin-bottom: 20px;
        }
        .variable-hint code {
            background: #e8f0fe;
            padding: 2px 6px;
            border-radius: 3px;
            color: #1e3a8a;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Edit WhatsApp Template
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="variable-hint">
                    <strong>Variable Usage:</strong> Use variables in your message by wrapping them in curly braces. 
                    For example: <code>{name}</code>, <code>{course}</code>, <code>{center}</code>, <code>{date}</code>
                    <br>
                    <strong>Available Variables:</strong> Enter comma-separated variable names (e.g., name, course, center, date)
                </div>

                <form method="POST" action="{{ route('admin.whatsapp_templates.update', $template->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Template Name <span class="text-danger">*</span></label>
                                <input type="text" name="template_name" class="form-control" value="{{ old('template_name', $template->template_name) }}" required placeholder="e.g., Student Registration, Exam Reminder">
                                <small class="form-text text-muted">Unique name for this template</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="8" required placeholder="Enter your message. Use {variable_name} for dynamic content.">{{ old('message', $template->message) }}</textarea>
                                <small class="form-text text-muted">Use {variable_name} syntax for variables</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Variables</label>
                                <input type="text" name="variables" class="form-control" value="{{ old('variables', $variablesString) }}" placeholder="name, course, center, date">
                                <small class="form-text text-muted">Comma-separated list of variable names used in the message</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="active" {{ old('status', $template->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $template->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update Template</button>
                            <a href="{{ route('admin.whatsapp_templates.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
@endpush

