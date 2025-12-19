<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;
use App\Helpers\ChatActor;

class NotificationBell extends Component
{
    public $notifications = [];
    public $unreadCount = 0;

    protected $listeners = ['notificationUpdated' => 'loadNotifications'];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $actor = ChatActor::current();
        if (!$actor) {
            return;
        }

        $this->notifications = Notification::getForUser($actor['type'], $actor['id'], 10);
        $this->unreadCount = Notification::getUnreadCount($actor['type'], $actor['id']);
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->markAsRead();
            $this->loadNotifications();
        }
    }

    public function markAllAsRead()
    {
        $actor = ChatActor::current();
        if (!$actor) {
            return;
        }

        Notification::markAllAsRead($actor['type'], $actor['id']);
        $this->loadNotifications();
    }

    public function getNotificationsRoute()
    {
        $actor = ChatActor::current();
        if (!$actor) {
            return '#';
        }

        if ($actor['type'] == 'admin_login') {
            return route('admin.notifications.index');
        } elseif ($actor['type'] == 'center_login') {
            return route('center.notifications.index');
        } elseif ($actor['type'] == 'student_login') {
            return route('student.notifications.index');
        }
        return '#';
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
