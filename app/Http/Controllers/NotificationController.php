<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Helpers\ChatActor;
use DB;

class NotificationController extends Controller
{
    public function index()
    {
        $actor = ChatActor::current();
        if (!$actor) {
            return redirect()->route('admin_login');
        }

        $notifications = Notification::where('user_type', $actor['type'])
            ->where('user_id', $actor['id'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Get routes based on user type
        $readAllRoute = $this->getReadAllRoute($actor['type']);
        $dashboardRoute = $this->getDashboardRoute($actor['type']);

        $readAllRoute = $this->getReadAllRoute($actor['type']);
        $dashboardRoute = $this->getDashboardRoute($actor['type']);
        $readRoute = function($id) use ($actor) {
            return $this->getReadRoute($actor['type'], $id);
        };

        return view('notifications.index', compact('notifications', 'readAllRoute', 'dashboardRoute', 'readRoute'));
    }

    private function getReadAllRoute($userType)
    {
        if ($userType == 'admin_login') {
            return route('admin.notifications.read-all');
        } elseif ($userType == 'center_login') {
            return route('center.notifications.read-all');
        } elseif ($userType == 'student_login') {
            return route('student.notifications.read-all');
        }
        return '#';
    }

    private function getDashboardRoute($userType)
    {
        if ($userType == 'admin_login') {
            return route('admin_dashboard');
        } elseif ($userType == 'center_login') {
            return route('center_dashboard');
        } elseif ($userType == 'student_login') {
            return route('student_dashboard');
        }
        return '#';
    }

    private function getReadRoute($userType, $id)
    {
        if ($userType == 'admin_login') {
            return route('admin.notifications.read', $id);
        } elseif ($userType == 'center_login') {
            return route('center.notifications.read', $id);
        } elseif ($userType == 'student_login') {
            return route('student.notifications.read', $id);
        }
        return '#';
    }

    public function markAsRead($id)
    {
        $actor = ChatActor::current();
        if (!$actor) {
            return response()->json(['success' => false], 401);
        }

        $notification = Notification::find($id);
        if ($notification && $notification->user_type == $actor['type'] && $notification->user_id == $actor['id']) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function markAllAsRead()
    {
        $actor = ChatActor::current();
        if (!$actor) {
            return response()->json(['success' => false], 401);
        }

        Notification::markAllAsRead($actor['type'], $actor['id']);
        return response()->json(['success' => true]);
    }
}
