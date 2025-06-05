<?php

namespace App\Livewire\Event\Informer;

use Livewire\Component;

class EventParticipiantList extends Component
{
    public $list = [];
    public function render()
    {
        return view('livewire.event.informer.event-participiant-list');
    }
}
