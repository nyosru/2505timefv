<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function render()
    {
        $events = Event::orderByDesc('event_date')->paginate($this->perPage);

        return view('livewire.event.listing', [
            'events' => $events,
        ]);
    }

//    public function render()
//    {
//        return view('livewire.event.listing');
//    }
}
