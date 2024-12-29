<?php

namespace App\Livewire\Page;

use App\Events\GenericChatRequestEvent;
use App\Models\ChatRequest;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{

    public $reason;

    public function render()
    {
        return view('livewire.page.home', [
            'user' => Auth::check(),
        ]);
    }

    public function chat()
    {
        $chatRequest = new ChatRequest();

        $subject = Subject::whereName($this->reason)->first();

        $chatRequest->user_id = Auth::id();
        $chatRequest->save();
        $chatRequest->subject()->attach($subject);
        $chatRequest->save();

        GenericChatRequestEvent::dispatch('new');

        $this->redirect('/chat');
    }
}
