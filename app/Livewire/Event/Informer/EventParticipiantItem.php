<?php

namespace App\Livewire\Event\Informer;

use Livewire\Component;

class EventParticipiantItem extends Component
{
    public $place;
    public $atlete;

    public function render()
    {
        return view('livewire.event.informer.event-participiant-item');
    }
}
