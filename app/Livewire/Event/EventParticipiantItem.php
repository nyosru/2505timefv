<?php

namespace App\Livewire\Event;

use Livewire\Component;

class EventParticipiantItem extends Component
{
    public $participant;
    public function render()
    {
        return view('livewire.event.event-participiant-item');
    }
}
