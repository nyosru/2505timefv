<?php

namespace App\Livewire\Event;

use Livewire\Component;

class ListingItem extends Component
{
    public $event;

    public function render()
    {
        return view('livewire.event.listing-item');
    }
}
