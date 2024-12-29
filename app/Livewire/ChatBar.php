<?php

namespace App\Livewire;

use App\Events\GenericChatRequestEvent;
use App\Events\PendingChatEvent;
use App\Models\ChatRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatBar extends Component
{

    public $requests;

    public function render()
    {

        $this->requests = ChatRequest::where('answered', false)->get();

        return view('livewire.chat-bar');
    }

    #[On('echo:listeners,GenericChatRequestEvent')]
    public function refresh($data)
    {

        if ($data['type'] === 'new') {
            $this->dispatch('request-notification');
        }

        $this->render();
    }

    public function accept(ChatRequest $chatRequest)
    {

        GenericChatRequestEvent::dispatch('change');

        $chatRequest->answered = true;
        $chatRequest->save();

        $chat = new \App\Models\Chat();
        $chat->listener_id = Auth::id();
        $chat->member_id = $chatRequest->user->id;
        $chat->save();

        PendingChatEvent::dispatch($chatRequest->user_id, $chat->id);

    }
}
