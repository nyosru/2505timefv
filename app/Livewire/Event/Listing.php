<?php

namespace App\Livewire\Event;

use App\Models\Event;
use App\Models\SportType;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $selectedSportType = null;
    protected $queryString = [
        'selectedSportType' => ['except' => null],
        'dateFilter' => ['except' => null],
    ];

    public $dateFilter;

    public function updatedSelectedSportType()
    {
        $this->resetPage();
    }

    public function updatedDateFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $now = Carbon::now();

        $events = Event::with([

//            'sportPlace' => function ($query) {
//
//                $query->select(['id', 'city_id', 'name']);
//
//                $query->with(['city' => function ($query) {
//
//                    $query->select(['id', 'country_id', 'name']);
//
//                    $query->with(['country' => function ($query) {
//                        $query->select(['id', 'name']);
//                    }]);
//                }]);
//            }
            'sportPlace:id,city_id,name',
            'sportPlace.city:id,country_id,name',
            'sportPlace.city.country:id,name',
            'sportTypes'
        ])
            ->when($this->selectedSportType, function ($query) {
                $query->whereHas('sportTypes', function ($q) {
                    $q->where('sport_types.id', $this->selectedSportType);
                });
            })

            ->when($this->dateFilter === 'past', function ($query) use ($now) {
                // Прошедшие: дата старта и финиша меньше текущей
//                $query
////                    ->where('event_date', '<', $now)
//                    ->where('events_date_finished', '<', $now);

                $query->where(function ($q) use ($now) {
                    $q
                        ->where(function ($q2) use ($now) {
                            // Стандартное условие: дата старта <= сейчас и дата финиша >= сейчас
                            $q2
//                                ->where('event_date', '<=', $now)
                                ->where('events_date_finished', '<', $now);
                        })
                        ->orWhere(function ($q3) use ($now) {
                            // Дополнительное условие: дата старта равна текущей дате и нет даты завершения
                            $q3->whereDate('event_date', '<', $now->toDateString())
                                ->whereNull('events_date_finished');
                        });
                });


            })

            ->when($this->dateFilter === 'current', function ($query) use ($now) {
                $query->where(function ($q) use ($now) {
                    $q
                        ->where(function ($q2) use ($now) {
                            // Стандартное условие: дата старта <= сейчас и дата финиша >= сейчас
                            $q2->where('event_date', '<=', $now)
                                ->where('events_date_finished', '>=', $now);
                        })
                        ->orWhere(function ($q3) use ($now) {
                            // Дополнительное условие: дата старта равна текущей дате и нет даты завершения
                            $q3->whereDate('event_date', '=', $now->toDateString())
                                ->whereNull('events_date_finished');
                        });
                });
            })
            ->when($this->dateFilter === 'upcoming', function ($query) use ($now) {
                // Скоро: дата старта и финиша больше текущей
                $query->where('event_date', '>', $now)//                    ->where('events_date_finished', '>', $now)
                ;
            })
//            ->orderByDesc('event_date')
            ->orderBy('event_date')
            ->paginate($this->perPage)
        ;

        $sport_types = SportType::whereHas('events')
//            ->get()
            ->orderBy('name')->pluck('name', 'id');

        return view('livewire.event.listing', [
            'events' => $events,
            'sport_types' => $sport_types,
        ]);
    }

//    public function render()
//    {
//        return view('livewire.event.listing');
//    }
}
