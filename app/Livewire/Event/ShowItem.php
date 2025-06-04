<?php

namespace App\Livewire\Event;

use Livewire\Component;

class ShowItem extends Component
{

    public $event;

    public function render()
    {
        return view('livewire.event.show-item');
    }
}
