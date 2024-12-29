<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class BeginChat extends ModalComponent
{
    public $reason;

    public $user;
    public function render()
    {

        $this->user = Auth::check();

        return view('livewire.begin-chat');
    }
}
