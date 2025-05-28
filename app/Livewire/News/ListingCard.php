<?php

namespace App\Livewire\News;

use Livewire\Component;

class ListingCard extends Component
{
    public $item;

    public function render()
    {
        return view('livewire.news.listing-card');
    }
}
