<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_type',
        'user_id',
        'type',
        'title',
        'message',
        'link',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get notifications for a user
     */
    public static function getForUser($userType, $userId, $limit = 10)
    {
        return self::where('user_type', $userType)
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get unread count for a user
     */
    public static function getUnreadCount($userType, $userId)
    {
        return self::where('user_type', $userType)
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->count();
    }

    /**
     * Mark as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Mark all as read for a user
     */
    public static function markAllAsRead($userType, $userId)
    {
        self::where('user_type', $userType)
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }
}
