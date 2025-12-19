<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ChatConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_one_type',
        'participant_one_id',
        'participant_two_type',
        'participant_two_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /**
     * Get or create a conversation between two participants
     */
    public static function getOrCreate($participantOneType, $participantOneId, $participantTwoType, $participantTwoId)
    {
        $conversation = self::where(function($query) use ($participantOneType, $participantOneId, $participantTwoType, $participantTwoId) {
            $query->where('participant_one_type', $participantOneType)
                  ->where('participant_one_id', $participantOneId)
                  ->where('participant_two_type', $participantTwoType)
                  ->where('participant_two_id', $participantTwoId);
        })->orWhere(function($query) use ($participantOneType, $participantOneId, $participantTwoType, $participantTwoId) {
            $query->where('participant_one_type', $participantTwoType)
                  ->where('participant_one_id', $participantTwoId)
                  ->where('participant_two_type', $participantOneType)
                  ->where('participant_two_id', $participantOneId);
        })->first();

        if (!$conversation) {
            $conversation = self::create([
                'participant_one_type' => $participantOneType,
                'participant_one_id' => $participantOneId,
                'participant_two_type' => $participantTwoType,
                'participant_two_id' => $participantTwoId,
            ]);
        }

        return $conversation;
    }

    /**
     * Get conversations for a user
     */
    public static function getForUser($userType, $userId)
    {
        return self::where(function($query) use ($userType, $userId) {
            $query->where('participant_one_type', $userType)
                  ->where('participant_one_id', $userId);
        })->orWhere(function($query) use ($userType, $userId) {
            $query->where('participant_two_type', $userType)
                  ->where('participant_two_id', $userId);
        })->orderBy('last_message_at', 'desc')->get();
    }

    /**
     * Get the other participant
     */
    public function getOtherParticipant($userType, $userId)
    {
        if ($this->participant_one_type == $userType && $this->participant_one_id == $userId) {
            return [
                'type' => $this->participant_two_type,
                'id' => $this->participant_two_id,
            ];
        }
        return [
            'type' => $this->participant_one_type,
            'id' => $this->participant_one_id,
        ];
    }

    /**
     * Get participant name
     */
    public function getParticipantName($type, $id)
    {
        if ($type == 'student_login') {
            $student = DB::table('student_login')->where('sl_id', $id)->first();
            return $student ? $student->sl_name : 'Unknown';
        } elseif ($type == 'center_login') {
            $center = DB::table('center_login')->where('cl_id', $id)->first();
            return $center ? $center->cl_center_name : 'Unknown';
        } elseif ($type == 'admin_login') {
            $admin = DB::table('admin_login')->where('al_id', $id)->first();
            return $admin ? $admin->al_name : 'Admin';
        }
        return 'Unknown';
    }

    /**
     * Relationship with messages
     */
    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'conversation_id')->orderBy('created_at', 'asc');
    }
}
