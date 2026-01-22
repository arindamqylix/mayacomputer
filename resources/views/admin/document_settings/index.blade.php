@extends('admin.layouts.base')
@section('title', 'Document Settings')

@push('custom-css')
<style>
    .modern-card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.5rem;
    }
    
    .list-header {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        padding: 1.5rem;
        border-radius: 0.5rem 0.5rem 0 0;
        color: white;
    }

    .btn-action {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: white;
        border: none;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        color: white;
    }

    .bg-gradient-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
    }
    
    .bg-gradient-delete {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
        background-image: linear-gradient(to top, #ff0844 0%, #ffb199 100%);
        color: white;
        border: none;
    }
</style>
@endpush

@section('content')
<div class="row mt-3">
    <!-- Add New Document Type -->
    <div class="col-md-4">
        <div class="card modern-card">
            <div class="card-header list-header">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Add Document Type</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.document_settings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Document Name</label>
                        <input type="text" name="dt_name" class="form-control" required placeholder="e.g. Migration Certificate">
                    </div>
                    <div class="mb-3">
                        <label>Amount (₹)</label>
                        <input type="number" step="0.01" name="dt_amount" class="form-control" required placeholder="e.g. 500">
                    </div>
                    <button type="submit" class="btn btn-action w-100">Add Document Type</button>
                </form>
            </div>
        </div>
    </div>

    <!-- List Document Types -->
    <div class="col-md-8">
        <div class="card modern-card">
            <div class="card-header list-header">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i> Available Document Types</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types as $key => $type)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <form action="{{ route('admin.document_settings.update', $type->dt_id) }}" method="POST" id="form-{{ $type->dt_id }}" class="d-flex gap-2">
                                        @csrf
                                        <input type="text" name="dt_name" value="{{ $type->dt_name }}" class="form-control form-control-sm">
                                </td>
                                <td>
                                        <input type="number" step="0.01" name="dt_amount" value="{{ $type->dt_amount }}" class="form-control form-control-sm" style="width: 100px;">
                                </td>
                                <td>
                                        <select name="dt_status" class="form-control form-control-sm">
                                            <option value="ACTIVE" {{ $type->dt_status == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                                            <option value="INACTIVE" {{ $type->dt_status == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                </td>
                                <td>
                                        <button type="submit" class="btn btn-sm bg-gradient-edit" title="Update">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.document_settings.delete', $type->dt_id) }}" class="btn btn-sm bg-gradient-delete ms-1" onclick="return confirm('Are you sure?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @if($types->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-3">No document types found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
