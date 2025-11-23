<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class ChatActor
{
    /**
     * Return current actor as ['type' => 'student_login'|'center_login'|'admin_login', 'id' => int]
     */
    public static function current()
    {
        if (Auth::guard('student')->check()) {
            return ['type' => 'student_login', 'id' => Auth::guard('student')->id()];
        }

        if (Auth::guard('center')->check()) {
            return ['type' => 'center_login', 'id' => Auth::guard('center')->id()];
        }

        if (Auth::guard('admin')->check()) {
            return ['type' => 'admin_login', 'id' => Auth::guard('admin')->id()];
        }

        // fallback to default web guard (if you keep admins there)
        if (Auth::check()) {
            return ['type' => 'admin_login', 'id' => Auth::id()];
        }

        return null;
    }
}
