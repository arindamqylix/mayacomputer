<?php
namespace App\Http\Livewire\Chat;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Helpers\ChatActor;
use Illuminate\Support\Str;

class ConversationWindow extends Component
{
    public $conversationId = null;
    public $messages = [];
    public $body = '';
    public $currentActor = null;

    protected $listeners = [
        'openConversation' => 'openConversation',
        'messageBroadcasted' => 'onExternalMessage'
    ];

    public function mount()
    {
        $this->currentActor = ChatActor::current();
    }

    public function openConversation($conversationId)
    {
        $this->conversationId = (int)$conversationId;
        $this->currentActor = ChatActor::current();

        if (! $this->canAccessConversation($this->conversationId)) {
            abort(403, 'Access denied to conversation');
        }

        DB::update("UPDATE conversation_participants SET last_read_at = ? WHERE conversation_id = ? AND participant_id = ? AND participant_type = ?",
            [now()->toDateTimeString(), $this->conversationId, $this->currentActor['id'], $this->currentActor['type']]);

        $this->loadMessages();
    }

    protected function canAccessConversation($conversationId)
    {
        $actor = $this->currentActor ?? ChatActor::current();
        if (! $actor) return false;
        $row = DB::selectOne("SELECT 1 FROM conversation_participants WHERE conversation_id = ? AND participant_id = ? AND participant_type = ? LIMIT 1",
            [$conversationId, $actor['id'], $actor['type']]);
        return (bool)$row;
    }

    public function loadMessages()
    {
        if (! $this->conversationId) {
            $this->messages = [];
            return;
        }
        $rows = DB::select("SELECT id, sender_id, sender_type, body, created_at FROM messages WHERE conversation_id = ? ORDER BY id ASC", [$this->conversationId]);
        $this->messages = array_map(fn($r) => (array)$r, $rows);
    }

    public function sendMessage()
    {
        $actor = ChatActor::current();
        if (! $actor || ! $this->conversationId) return;

        $this->validate(['body' => 'required|string|max:5000']);

        $exists = DB::selectOne("SELECT 1 FROM conversation_participants WHERE conversation_id = ? AND participant_id = ? AND participant_type = ? LIMIT 1",
            [$this->conversationId, $actor['id'], $actor['type']]);
        if (! $exists) { session()->flash('error','You are not a participant.'); return; }

        $parts = DB::select("SELECT participant_type, participant_id FROM conversation_participants WHERE conversation_id = ?", [$this->conversationId]);
        $types = array_map(fn($p) => $p->participant_type, $parts);

        // Business rules Option B (centers can chat with students and admins)
        if ($actor['type'] === 'student_login') {
            $row = DB::selectOne("SELECT sl_FK_of_center_id as center_id FROM student_login WHERE sl_id = ?", [$actor['id']]);
            if (! $row || ! in_array('center_login', $types) || $row->center_id === null) {
                session()->flash('error', 'Students can only chat with their assigned center.'); return;
            }
            $centerPart = DB::selectOne("SELECT participant_id FROM conversation_participants WHERE conversation_id = ? AND participant_type = 'center_login' LIMIT 1", [$this->conversationId]);
            if (! $centerPart || (int)$centerPart->participant_id !== (int)$row->center_id) {
                session()->flash('error', 'This conversation does not belong to your assigned center.'); return;
            }
        }

        if ($actor['type'] === 'center_login') {
            if (! (in_array('student_login', $types) || in_array('admin_login', $types))) {
                session()->flash('error', 'Center can only chat with students or admins.'); return;
            }
        }

        if ($actor['type'] === 'admin_login') {
            if (! in_array('center_login', $types)) {
                session()->flash('error', 'Admin can only chat with centers.'); return;
            }
        }

        $safeBody = strip_tags($this->body);
        DB::insert("INSERT INTO messages (conversation_id, sender_id, sender_type, body, created_at) VALUES (?, ?, ?, ?, ?)",
            [$this->conversationId, $actor['id'], $actor['type'], $safeBody, now()->toDateTimeString()]);

        $this->body = '';
        $this->loadMessages();

        $payload = [
            'conversation_id' => $this->conversationId,
            'sender_id' => $actor['id'],
            'sender_type' => $actor['type'],
            'body' => Str::limit($safeBody, 2000),
            'created_at' => now()->toDateTimeString()
        ];

        if (class_exists(\App\Events\MessageSentRaw::class)) {
            event(new \App\Events\MessageSentRaw($payload));
        }

        $this->emit('messageBroadcasted', $payload);
    }

    public function onExternalMessage($payload)
    {
        if (! isset($payload['conversation_id'])) return;
        if ((int)$payload['conversation_id'] === (int)$this->conversationId) {
            $this->loadMessages();
        }
    }

    public function render()
    {
        return view('livewire.chat.conversation-window');
    }
}
