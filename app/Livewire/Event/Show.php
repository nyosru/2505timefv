<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class Show extends Component
{

    public Event $event;
    public Event $event_no_place;

    public function mount($id)
    {

        $this->event = Event::with([
            'athletes' => function ($query) {
                $query->withPivot('place')
                    ->where('place', '!=', 0)
                    ->orderBy('place', 'asc');
            },
            'athletesNoPlace' => function ($query) {
                $query->withPivot('place')
                    ->where('place', '=', null)
//                    ->orderBy('place', 'asc')
                ;
            },
            'sportType:id,name',
            'sportPlace' => function ($query) {
                $query->select('id', 'city_id', 'name')->with([
                    'city' => function ($query) {
                        $query->select('id', 'country_id', 'name')->with([
                            'country:id,name'
                        ]);
                    }
                ]);
            },
            'photos',
            'docs',
            'videos',
//            'attachments'
        ])->findOrFail($id);


    }


    public function render()
    {
        return view('livewire.event.show');
    }
}
