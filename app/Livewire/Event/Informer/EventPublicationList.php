<?php

namespace App\Livewire\Event\Informer;

use Livewire\Component;

class EventPublicationList extends Component
{
    public $items = [];

    public function render()
    {
        return view('livewire.event.informer.event-publication-list');
    }
}
