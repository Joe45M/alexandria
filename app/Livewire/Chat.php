<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Events\TypingEvent;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Chat extends Component
{


    public $message = "";
    public $conversation = [];

    #[Url]
    public $pdchat; // pre defined chat

    public $chats;

    public $currentChat;

    public $pendingRequest = false;

    public function mount()
    {
        $this->currentChat = Auth::user()->chats()->first();

        if ($this->pdchat) {
            $this->setChat(\App\Models\Chat::find($this->pdchat));
        }

    }


    public function setChat(\App\Models\Chat $chat) {
        $this->currentChat = $chat;

        // set new messages to read
        $type = Auth::user()->type;

        $messages = $this->currentChat->unread;

        $messages->each(function ($el) {
            $el->read_at = now();
            $el->save();
        });

        $this->dispatch('chat-selected');
    }

    public function submitMessage() {

        $chatMessage = new ChatMessage();
        $chatMessage->message = $this->message;
        $chatMessage->user_id = Auth::id();
        $chatMessage->chat_id = $this->currentChat->id;
        $chatMessage->save();

        $this->currentChat->touch();

        $this->reset('message');
        $this->dispatch('new-message');
        $this->render();
        MessageEvent::dispatch($this->message, $this->currentChat);
    }

    public function typing()
    {

        TypingEvent::dispatch($this->currentChat);
    }

    #[On('echo:chat.{currentChat.id},MessageEvent')]
    public function listenForMessage($data) {
        $this->currentChat->refresh();
    }

    public function render()
    {

        if (Auth::user()->chatRequests) {
            $this->pendingRequest = true;
        }

        $this->chats = Auth::user()->chats;

        return view('livewire.chat')->layout('layouts.app');
    }
}
