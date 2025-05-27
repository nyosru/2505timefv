<?php

namespace App\Livewire\Athlete;

use Livewire\Component;

class ListingCard extends Component
{
    public $athlete;

    public function render()
    {
        return view('livewire.athlete.listing-card');
    }
}
