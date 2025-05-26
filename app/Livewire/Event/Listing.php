<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $perPage = 10;

//    #[Url]
//    public $page = 1;

    public function render()
    {
        $events = Event::with([
            'sportPlace' => function ($query) {

                $query->select(['id', 'city_id', 'name']);

                $query->with(['city' => function ($query) {

                    $query->select(['id', 'country_id', 'name']);

                    $query->with(['country' => function ($query) {
                        $query->select(['id',  'name']);
                    }]);
                }]);
            }
        ])->orderByDesc('event_date')->paginate($this->perPage);

        return view('livewire.event.listing', [
            'events' => $events,
        ]);
    }

//    public function render()
//    {
//        return view('livewire.event.listing');
//    }
}
