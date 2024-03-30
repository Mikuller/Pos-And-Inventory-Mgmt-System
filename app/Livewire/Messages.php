<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class Messages extends Component
{
    public $search;
    public function render()
    {
        $messages =  Message::where('id', '=', $this->search)
                ->orWhere('senderName', 'like', "%{$this->search}%")
                ->orWhere('senderEmail', 'like', "%{$this->search}%")
                ->orWhere('phoneNumber', '=', $this->search)
                ->orWhere('status', 'like', "%{$this->search}%")
                ->orWhere('message', 'like',"%{$this->search}%")
            ->latest()->paginate(7);
        return view('livewire.messages', compact('messages'));
    }
}
