@extends('admin.layouts.base')
@section('title', 'Notifications')
@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Notifications
                <span class='float-right' style='float:right'>
                    <form action="{{ $readAllRoute }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm">Mark All as Read</button>
                    </form>
                    <a href="{{ $dashboardRoute }}">  
                        <button type="button" class="btn btn-dark btn-sm"> Back </button>
                    </a>
                </span>
            </div>
            <div class="card-body">
                @forelse($notifications as $notification)
                    <div class="card mb-3 {{ !$notification->is_read ? 'border-primary' : '' }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">{{ $notification->title }}</h5>
                                    <p class="card-text">{{ $notification->message }}</p>
                                    <small class="text-muted">
                                        <i class="bx bx-time"></i> {{ $notification->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div>
                                    @if($notification->link)
                                        <a href="{{ $notification->link }}" class="btn btn-sm btn-primary">View</a>
                                    @endif
                                    @if(!$notification->is_read)
                                        <form action="{{ $readRoute($notification->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Mark as Read</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-5">
                        <i class="bx bx-bell" style="font-size: 48px; color: #ccc;"></i>
                        <p class="mt-3 text-muted">No notifications found</p>
                    </div>
                @endforelse

                <div class="mt-3">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
