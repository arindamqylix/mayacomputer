<?php

use Illuminate\Support\Facades\DB;
use App\Helpers\ChatActor;

Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    $actor = ChatActor::current();
    if (! $actor) return false;

    $row = DB::selectOne("SELECT 1 FROM conversation_participants WHERE conversation_id = ? AND participant_id = ? AND participant_type = ? LIMIT 1",
        [$conversationId, $actor['id'], $actor['type']]);

    return (bool)$row;
});

