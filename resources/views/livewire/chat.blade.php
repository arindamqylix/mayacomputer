<div class="container-fluid" wire:key="chat-container">
    <div class="row">
        <!-- Chat Users List -->
        <div class="col-md-4 border-end">
            <div class="p-3 border-bottom">
                <h5>Chats</h5>
            </div>
            <div class="list-group list-group-flush" style="max-height: 600px; overflow-y: auto;">
                @forelse($users as $index => $user)
                    <button type="button" 
                            onclick="console.log('Button clicked:', '{{ $user['type'] }}', {{ (int)$user['id'] }})"
                            wire:click.prevent="selectConversation('{{ $user['type'] }}', {{ (int)$user['id'] }})"
                            wire:key="chat-user-{{ $user['type'] }}-{{ $user['id'] }}-{{ $index }}"
                            style="width: 100%; text-align: left; border: none; background: transparent; padding: 0.75rem 1rem; cursor: pointer;"
                            class="list-group-item list-group-item-action {{ $selectedConversation && $otherParticipant && $otherParticipant['type'] == $user['type'] && $otherParticipant['id'] == $user['id'] ? 'active' : '' }}">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $user['name'] }}</h6>
                        </div>
                        <small>{{ ucfirst(str_replace('_', ' ', $user['type'])) }}</small>
                    </button>
                @empty
                    <div class="p-3 text-center text-muted">
                        <p>No users available to chat</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="col-md-8">
            @if($selectedConversation && $otherParticipant)
                <div class="d-flex flex-column" style="height: 600px;">
                    <!-- Chat Header -->
                    <div class="p-3 border-bottom bg-light">
                        @php
                            $conversation = \App\Models\ChatConversation::find($selectedConversation);
                            $participantName = $conversation ? $conversation->getParticipantName($otherParticipant['type'], $otherParticipant['id']) : 'Unknown';
                        @endphp
                        <h5>{{ $participantName }}</h5>
                        <small class="text-muted">{{ ucfirst(str_replace('_', ' ', $otherParticipant['type'])) }}</small>
                    </div>

                    <!-- Messages Area -->
                    <div class="flex-grow-1 p-3" style="overflow-y: auto; background-color: #f8f9fa;" id="messages-container">
                        @foreach($messages as $message)
                            @php
                                $actor = \App\Helpers\ChatActor::current();
                                $isMyMessage = $message['sender_type'] == $actor['type'] && $message['sender_id'] == $actor['id'];
                            @endphp
                            <div class="d-flex mb-3 {{ $isMyMessage ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="message-bubble {{ $isMyMessage ? 'bg-primary text-white' : 'bg-white' }}" 
                                     style="max-width: 70%; padding: 10px 15px; border-radius: 18px; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
                                    <p class="mb-1">{{ $message['message'] }}</p>
                                    <small class="{{ $isMyMessage ? 'text-white-50' : 'text-muted' }}" style="font-size: 0.75rem;">
                                        {{ \Carbon\Carbon::parse($message['created_at'])->format('h:i A') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Message Input -->
                    <div class="p-3 border-top bg-white">
                        <form wire:submit.prevent="sendMessage">
                            <div class="input-group">
                                <input type="text" 
                                       wire:model="newMessage" 
                                       class="form-control" 
                                       placeholder="Type a message..." 
                                       autocomplete="off">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bx bx-send"></i> Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="d-flex align-items-center justify-content-center" style="height: 600px;">
                    <div class="text-center text-muted">
                        <i class="bx bx-chat" style="font-size: 48px; margin-bottom: 15px;"></i>
                        <p>Select a user to start chatting</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('custom-js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== Chat Component Debug ===');
        console.log('Livewire available:', typeof window.Livewire !== 'undefined');
        
        // Check for wire:click elements
        setTimeout(function() {
            const wireClickElements = document.querySelectorAll('[wire\\:click]');
            console.log('Found', wireClickElements.length, 'elements with wire:click');
            
            // Check if Livewire component exists
            if (typeof window.Livewire !== 'undefined') {
                const components = window.Livewire.all();
                console.log('Livewire components found:', Object.keys(components).length);
                Object.keys(components).forEach(function(id) {
                    console.log('Component ID:', id);
                });
            }
        }, 2000);
        
        function scrollToBottom() {
            const container = document.getElementById('messages-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }

        if (typeof window.Livewire !== 'undefined') {
            window.Livewire.on('scrollToBottom', scrollToBottom);
        } else {
            document.addEventListener('livewire:load', function () {
                window.Livewire.on('scrollToBottom', scrollToBottom);
            });
        }
        
        setTimeout(scrollToBottom, 500);
    });
</script>
@endpush
