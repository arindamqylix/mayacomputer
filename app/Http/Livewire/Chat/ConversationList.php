<?php
namespace App\Http\Livewire\Chat;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Helpers\ChatActor;

class ConversationList extends Component
{
    public $conversations = [];

    protected $listeners = [
        'openConversation' => 'openConversation',
        'messageBroadcasted' => 'onExternalMessage'
    ];


    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $actor = ChatActor::current();
        if (! $actor) {
            $this->conversations = [];
            return;
        }

        $sql = "
          SELECT c.id as conversation_id, c.type,
                 cp.participant_id as other_id, cp.participant_type as other_type,
                 (SELECT body FROM messages WHERE conversation_id=c.id ORDER BY id DESC LIMIT 1) as last_message,
                 (SELECT created_at FROM messages WHERE conversation_id=c.id ORDER BY id DESC LIMIT 1) as last_message_time
          FROM conversations c
          JOIN conversation_participants me ON me.conversation_id = c.id
          JOIN conversation_participants cp ON cp.conversation_id = c.id
            AND NOT (cp.participant_id = me.participant_id AND cp.participant_type = me.participant_type)
          WHERE me.participant_id = ? AND me.participant_type = ?
          ORDER BY last_message_time DESC
        ";

        $rows = DB::select($sql, [$actor['id'], $actor['type']]);

        $convos = [];
        foreach ($rows as $r) {
            $otherName = $this->fetchParticipantName($r->other_type, $r->other_id);
            $convos[] = [
                'conversation_id' => (int)$r->conversation_id,
                'type' => $r->type,
                'other_id' => (int)$r->other_id,
                'other_type' => $r->other_type,
                'other_name' => $otherName,
                'last_message' => $r->last_message,
                'last_message_time' => $r->last_message_time,
            ];
        }

        $this->conversations = $convos;
    }

    protected function fetchParticipantName($table, $id)
    {
        if ($table === 'student_login') {
            $row = DB::selectOne("SELECT sl_name as name FROM student_login WHERE sl_id = ?", [$id]);
            return $row->name ?? 'Student';
        }
        if ($table === 'center_login') {
            $row = DB::selectOne("SELECT cl_center_name as name FROM center_login WHERE cl_id = ?", [$id]);
            return $row->name ?? 'Center';
        }
        if ($table === 'admin_login') {
            $row = DB::selectOne("SELECT al_name as name FROM admin_login WHERE al_id = ?", [$id]);
            return $row->name ?? 'Admin';
        }
        return 'User';
    }

    public function openConversation($conversationId)
    {
        \Log::info('ConversationWindow::openConversation called', ['conversation' => $conversationId, 'actor' => ChatActor::current()]);
        // Emit targeted to the window and also a global event as fallback.
        $this->emitTo('chat.conversation-window', 'openConversation', (int)$conversationId);

        // Global emit (so ConversationWindow listening for global events also receives it)
        $this->emit('openConversation', (int)$conversationId);

        // optional server-side log (helps debugging)
        \Log::info('ConversationList::openConversation emitted', ['conversation' => $conversationId, 'actor' => \App\Helpers\ChatActor::current()]);
    }


    public function render()
    {
        return view('livewire.chat.conversation-list');
    }
}
