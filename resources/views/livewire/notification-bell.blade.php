<div>
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" 
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-bell" style="color: #74788d !important; font-size: 20px;"></i>
            @if($unreadCount > 0)
                <span class="badge bg-danger rounded-pill" style="position: absolute; top: 8px; right: 8px; font-size: 10px;">
                    {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                </span>
            @endif
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 font-size-16"> Notifications </h6>
                    </div>
                    @if($unreadCount > 0)
                        <div class="col-auto">
                            <a href="javascript:void(0);" wire:click="markAllAsRead" class="badge bg-info"> Mark all as read</a>
                        </div>
                    @endif
                </div>
            </div>
            <div data-simplebar style="max-height: 230px;">
                @forelse($notifications as $notification)
                    <a href="{{ $notification->link ?: 'javascript:void(0);' }}" 
                       wire:click="markAsRead({{ $notification->id }})"
                       class="text-reset notification-item {{ !$notification->is_read ? 'bg-light' : '' }}">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="bx bx-envelope"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $notification->title }}</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">{{ Str::limit($notification->message, 60) }}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center p-3">
                        <p class="text-muted mb-0">No notifications</p>
                    </div>
                @endforelse
            </div>
            @if(count($notifications) > 0)
                <div class="p-2 border-top">
                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ $this->getNotificationsRoute() }}">
                        View All <i class="mdi mdi-arrow-right ms-1"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.notification-item:hover {
    background-color: #f8f9fa !important;
}
</style>

@push('custom-js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Wait for Livewire to be available
        if (typeof window.Livewire !== 'undefined') {
            window.Livewire.on('notificationUpdated', () => {
                @this.call('loadNotifications');
            });
        } else {
            document.addEventListener('livewire:load', function () {
                window.Livewire.on('notificationUpdated', () => {
                    @this.call('loadNotifications');
                });
            });
        }
    });
</script>
@endpush
