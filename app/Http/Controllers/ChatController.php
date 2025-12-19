<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Helpers\ChatActor;

class ChatController extends Controller
{
    public function index($recipientType = null, $recipientId = null)
    {
        $actor = ChatActor::current();
        $layout = 'admin.layouts.base'; // default
        
        if ($actor && $actor['type'] == 'center_login') {
            $layout = 'center.layouts.base';
        } elseif ($actor && $actor['type'] == 'student_login') {
            $layout = 'student.layouts.base';
        }
        
        return view('chat.index', compact('recipientType', 'recipientId', 'layout'));
    }
}
