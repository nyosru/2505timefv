<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class Show extends Component
{

    public Event $event;

    public function mount($id)
    {
        $this->event = Event::with([
            'sportType' => function ($query) {
                $query->select(['id', 'name']);
            },
            'sportPlace' => function ($query) {

                $query->select(['id', 'city_id', 'name']);

                $query->with(['city' => function ($query) {

                    $query->select(['id', 'country_id', 'name']);

                    $query->with(['country' => function ($query) {
                        $query->select(['id',  'name']);
                    }]);
                }]);
            }
        ])->findOrFail($id);
    }


    public function render()
    {
        return view('livewire.event.show');
    }
}
