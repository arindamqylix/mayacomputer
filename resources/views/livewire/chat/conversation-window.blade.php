<div>
  @if(!$conversationId)
    <div class="text-muted">Select a conversation to begin.</div>
  @else
    <div class="card">
      <div class="card-body" style="height:360px; overflow:auto;" wire:poll.2500ms="loadMessages">
        @foreach($messages as $m)
          @php
            $isMine = ($m['sender_type'] === ($currentActor['type'] ?? null) && (int)$m['sender_id'] === (int)($currentActor['id'] ?? 0));
          @endphp

          <div class="mb-2 d-flex {{ $isMine ? 'justify-content-end' : 'justify-content-start' }}">
            <div style="max-width: 75%;">
              <div class="small text-muted">
                {{ $m['sender_type'] }}
              </div>

              <div class="p-2 {{ $isMine ? 'bg-primary text-white' : 'bg-light text-dark' }} rounded">
                {!! nl2br(e($m['body'])) !!}
              </div>

              <div class="small text-muted">{{ $m['created_at'] }}</div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="card-footer">
        <form wire:submit.prevent="sendMessage">
          <textarea wire:model.defer="body" class="form-control" rows="2" placeholder="Type a message..."></textarea>
          <div class="mt-2 d-flex justify-content-end">
            <button class="btn btn-sm btn-success">Send</button>
          </div>
        </form>
      </div>
    </div>
  @endif
</div>
