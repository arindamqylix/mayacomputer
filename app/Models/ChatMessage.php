<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_type',
        'sender_id',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Relationship with conversation
     */
    public function conversation()
    {
        return $this->belongsTo(ChatConversation::class, 'conversation_id');
    }

    /**
     * Mark as read
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Get unread count for a conversation and user
     */
    public static function getUnreadCount($conversationId, $userType, $userId)
    {
        return self::where('conversation_id', $conversationId)
            ->where('is_read', false)
            ->where(function($query) use ($userType, $userId) {
                $query->where('sender_type', '!=', $userType)
                      ->orWhere('sender_id', '!=', $userId);
            })
            ->count();
    }
}
