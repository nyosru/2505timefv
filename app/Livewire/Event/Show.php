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

            'groupsNagrada' => function ($query) {
                $query->with(['athletes' => function ($query) {
                    $query->orderByRaw('place IS NULL, place ASC');
                }]);
            },

//            'groupsNagrada' => function ($query) {
//                $query->orderBy('name', 'asc')  // сортируем группы наград по возрастанию (например, по полю name)
//                ->with(['eventParticipants.athlete']); // подгружаем участников и их спортсменов
//            },

            'guests' => function ($query) {
//            $query->with('guests');
            },
            'athletes' => function ($query) {
                $query
                    ->withPivot(['place',
//                        'event_group_nagrada_id'
                    ])
                    ->with([
                        'eventParticipants' => function ($query) {
                            $query->with('eventGroupNagrada');
                        },
//                        'eventGroupNagrada'
                    ])
//                    ->where('place', '!=', 0)
//                    ->orderBy('place', 'asc')
//                    ->orderBy('eventGroupNagrada_id', 'DESC')
                    ->orderByRaw('place IS NULL, place ASC')
                ;
            },
//            'athletes' => function ($query) {
//                $query->withPivot('place')
//                    ->where('place', '!=', 0)
//                    ->orderBy('place', 'asc');
//            },
//            'athletesNoPlace' => function ($query) {
//                $query->withPivot('place')
//                    ->where('place', '=', null)
////                    ->orderBy('place', 'asc')
//                ;
//            },

//            'sportType:id,name',
            'sportTypes:id,name',
            'sportPlace' => function ($query) {
                $query->select('id', 'city_id', 'name', 'adress')->with([
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

//        $this->participants = EventParticipant::with('athlete')
//            ->where('event_id', $value)
//            ->orderByRaw('place IS NULL, place ASC')
//            ->get();


    }


    public function render()
    {
        return view('livewire.event.show');
    }
}
