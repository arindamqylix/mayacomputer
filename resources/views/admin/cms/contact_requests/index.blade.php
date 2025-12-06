@extends('admin.layouts.base')
@section('title', 'Contact Request List')
@push('custom-css')
<style type="text/css">
    .table_main_row th {
        text-align: center;
    }
    .message-preview {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Contact Request List
                <span class="badge bg-light text-dark float-end">{{ $contacts->total() }} Total</span>
            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered table-sm table-striped w-100">
                    <thead>
                        <tr class="table_main_row">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>
                                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                </td>
                                <td>
                                    @if($contact->phone)
                                        <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $contact->subject }}</td>
                                <td class="message-preview" title="{{ $contact->message }}">
                                    {{ \Illuminate\Support\Str::limit($contact->message, 50) }}
                                </td>
                                <td>
                                    @if($contact->created_at)
                                        {{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y h:i A') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $contact->id }}">
                                        View
                                    </button>
                                    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this request?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $contact->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $contact->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary text-white">
                                            <h5 class="modal-title" id="viewModalLabel{{ $contact->id }}">Contact Request Details</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-4"><strong>ID:</strong></div>
                                                <div class="col-md-8">{{ $contact->id }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4"><strong>Name:</strong></div>
                                                <div class="col-md-8">{{ $contact->name }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4"><strong>Email:</strong></div>
                                                <div class="col-md-8">
                                                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4"><strong>Phone:</strong></div>
                                                <div class="col-md-8">
                                                    @if($contact->phone)
                                                        <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4"><strong>Subject:</strong></div>
                                                <div class="col-md-8">{{ $contact->subject }}</div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4"><strong>Message:</strong></div>
                                                <div class="col-md-8">
                                                    <div class="border p-3 rounded bg-light">
                                                        {{ $contact->message }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4"><strong>Created At:</strong></div>
                                                <div class="col-md-8">
                                                    @if($contact->created_at)
                                                        {{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y h:i A') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No contact requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- Pagination -->
                @if($contacts->hasPages())
                <div class="mt-3">
                    {{ $contacts->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
@endpush
