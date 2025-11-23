<div>
  <h5 class="mb-2">Conversations</h5>

  @if(empty($conversations))
    <div class="text-muted">No conversations yet.</div>
  @else
    <ul class="list-group">
      @foreach($conversations as $c)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <strong>{{ $c['other_name'] }}</strong><br>
            <small class="text-muted">{{ \Illuminate\Support\Str::limit($c['last_message'] ?? '', 60) }}</small>
          </div>
          <div>
            <button wire:click="openConversation({{ $c['conversation_id'] }})" class="btn btn-sm btn-primary">Open</button>
          </div>
        </li>
      @endforeach
    </ul>
  @endif
</div>
