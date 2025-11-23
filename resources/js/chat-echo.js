// requires Echo configured (pusher or websockets). This function subscribes to a given convId.
export function startConversationEcho(convId) {
  if (!window.Echo) return;
  window.Echo.private('conversation.' + convId)
    .listen('MessageSentRaw', (e) => {
      // forward to Livewire so components update
      if (window.livewire) {
        window.livewire.emit('messageBroadcasted', e);
      }
    });
}
