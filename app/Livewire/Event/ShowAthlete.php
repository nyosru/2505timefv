<?php

namespace App\Livewire\Event;

use Livewire\Component;

class ShowAthlete extends Component
{
    public $athlete;

    public function render()
    {
        return view('livewire.event.show-athlete');
    }
}
