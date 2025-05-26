<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class Show extends Component
{

    public Event $event;

    public function mount($id)
    {
        $this->event = Event::findOrFail($id);
    }


    public function render()
    {
        return view('livewire.event.show');
    }
}
