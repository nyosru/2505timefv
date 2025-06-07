<?php

namespace App\Livewire\Event;

use Livewire\Component;

class ShowPhotoList extends Component
{
    public $event;
    public function render()
    {
        return view('livewire.event.show-photo-list');
    }
}
