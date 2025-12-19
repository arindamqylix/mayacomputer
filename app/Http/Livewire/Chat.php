<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\Notification;
use App\Helpers\ChatActor;
use DB;
use Auth;

class Chat extends Component
{
    public $conversations = [];
    public $selectedConversation = null;
    public $messages = [];
    public $newMessage = '';
    public $otherParticipant = null;
    public $recipientType = '';
    public $recipientId = '';

    protected $listeners = ['refreshChat' => '$refresh'];

    public function mount($recipientType = null, $recipientId = null)
    {
        $this->loadConversations();
        if ($recipientType && $recipientId) {
            $this->recipientType = $recipientType;
            $this->recipientId = $recipientId;
            $this->selectConversation($recipientType, $recipientId);
        }
    }

    public function loadConversations()
    {
        $actor = ChatActor::current();
        if (!$actor) {
            $this->conversations = [];
            return;
        }

        $this->conversations = ChatConversation::getForUser($actor['type'], $actor['id']);
    }

    public function selectConversation($recipientType, $recipientId)
    {
        \Log::info('selectConversation called', ['type' => $recipientType, 'id' => $recipientId]);
        
        $actor = ChatActor::current();
        if (!$actor) {
            \Log::error('No actor found in selectConversation');
            session()->flash('error', 'User not authenticated');
            return;
        }

        try {
            $conversation = ChatConversation::getOrCreate(
                $actor['type'],
                $actor['id'],
                $recipientType,
                (int)$recipientId
            );

            $this->selectedConversation = $conversation->id;
            $this->otherParticipant = $conversation->getOtherParticipant($actor['type'], $actor['id']);
            
            // Ensure otherParticipant is an array
            if (is_object($this->otherParticipant)) {
                $this->otherParticipant = (array)$this->otherParticipant;
            }
            
            $this->loadMessages();
            
            // Mark messages as read (messages NOT sent by current user)
            ChatMessage::where('conversation_id', $conversation->id)
                ->where(function($query) use ($actor) {
                    $query->where('sender_type', '!=', $actor['type'])
                          ->orWhere(function($q) use ($actor) {
                              $q->where('sender_type', $actor['type'])
                                ->where('sender_id', '!=', $actor['id']);
                          });
                })
                ->where('is_read', false)
                ->update(['is_read' => true]);
                
            \Log::info('Conversation selected successfully', ['conversation_id' => $conversation->id]);
            
            // Force component to refresh
            $this->emit('$refresh');
        } catch (\Exception $e) {
            \Log::error('Chat selectConversation error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            session()->flash('error', 'Error selecting conversation: ' . $e->getMessage());
        }
    }

    public function loadMessages()
    {
        if (!$this->selectedConversation) {
            return;
        }

        $this->messages = ChatMessage::where('conversation_id', $this->selectedConversation)
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();

        $this->dispatchBrowserEvent('scrollToBottom');
    }

    public function sendMessage()
    {
        if (empty(trim($this->newMessage))) {
            return;
        }

        $actor = ChatActor::current();
        if (!$actor || !$this->selectedConversation) {
            return;
        }

        ChatMessage::create([
            'conversation_id' => $this->selectedConversation,
            'sender_type' => $actor['type'],
            'sender_id' => $actor['id'],
            'message' => trim($this->newMessage),
            'is_read' => false,
        ]);

        // Update conversation last message time
        ChatConversation::where('id', $this->selectedConversation)
            ->update(['last_message_at' => now()]);

        // Create notification for recipient
        $conversation = ChatConversation::find($this->selectedConversation);
        $otherParticipant = $conversation->getOtherParticipant($actor['type'], $actor['id']);
        
        $senderName = $conversation->getParticipantName($actor['type'], $actor['id']);
        
        Notification::create([
            'user_type' => $otherParticipant['type'],
            'user_id' => $otherParticipant['id'],
            'type' => 'chat_message',
            'title' => 'New Message from ' . $senderName,
            'message' => substr(trim($this->newMessage), 0, 100),
            'link' => $this->getChatRoute($actor['type']),
        ]);

        $this->newMessage = '';
        $this->loadMessages();
        $this->loadConversations();
        
        // Emit event to refresh notifications and scroll to bottom
        $this->emit('notificationUpdated');
        $this->dispatchBrowserEvent('scrollToBottom');
    }

    public function render()
    {
        $actor = ChatActor::current();
        if (!$actor) {
            $layout = 'admin.layouts.base';
            return view('livewire.chat', ['users' => []])->layout($layout);
        }

        // Get list of users that current user can chat with
        $users = $this->getAvailableUsers($actor['type'], $actor['id']);

        return view('livewire.chat', compact('users'));
    }

    private function getAvailableUsers($userType, $userId)
    {
        $users = [];

        if ($userType == 'student_login') {
            // Students can chat with their center
            $student = DB::table('student_login')->where('sl_id', $userId)->first();
            if ($student) {
                $center = DB::table('center_login')->where('cl_id', $student->sl_FK_of_center_id)->first();
                if ($center) {
                    $users[] = [
                        'type' => 'center_login',
                        'id' => $center->cl_id,
                        'name' => $center->cl_center_name,
                    ];
                }
            }
        } elseif ($userType == 'center_login') {
            // Centers can chat with students in their center and admin
            $centerStudents = DB::table('student_login')
                ->where('sl_FK_of_center_id', $userId)
                ->select('sl_id', 'sl_name')
                ->get();
            
            foreach ($centerStudents as $student) {
                $users[] = [
                    'type' => 'student_login',
                    'id' => $student->sl_id,
                    'name' => $student->sl_name,
                ];
            }

            // Add admin
            $admins = DB::table('admin_login')->select('al_id', 'al_name')->get();
            foreach ($admins as $admin) {
                $users[] = [
                    'type' => 'admin_login',
                    'id' => $admin->al_id,
                    'name' => $admin->al_name,
                ];
            }
        } elseif ($userType == 'admin_login') {
            // Admins can chat with all centers
            $centers = DB::table('center_login')->select('cl_id', 'cl_center_name')->get();
            foreach ($centers as $center) {
                $users[] = [
                    'type' => 'center_login',
                    'id' => $center->cl_id,
                    'name' => $center->cl_center_name,
                ];
            }
        }

        return $users;
    }

    /**
     * Get chat route based on current user type
     */
    private function getChatRoute($userType)
    {
        if ($userType == 'admin_login') {
            return route('admin.chat');
        } elseif ($userType == 'center_login') {
            return route('center.chat');
        } elseif ($userType == 'student_login') {
            return route('student.chat');
        }
        return '#';
    }
}
