<?php

namespace App\Livewire\News;

use App\Models\News;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortDirection = 'desc'; // 'desc' — сначала новые, 'asc' — сначала старые
    public $selectedEvent = '';
    public $selectedAthlete = '';
    public $selectedSportType = '';

    protected $queryString = [
        'sortDirection' => ['except' => 'desc'],
        'selectedEvent' => [
//            'except' => ''
        ],
        'selectedAthlete' => [
//            'except' => ''
        ],
        'selectedSportType' => [
//            'except' => ''
        ],
    ];

    public function render()
    {

//        $user = User::with([
//            'roles',
//            'roles.permissions'
//        ])->get();


//        $news = News::query()
        $news = News::with(['event', 'athlete', 'sportTypes', 'userAutor'])
            ->when($this->selectedEvent, fn($q) => $q->where('event_id', $this->selectedEvent))
            ->when($this->selectedAthlete, fn($q) => $q->where('athlete_id', $this->selectedAthlete))
//            ->when($this->selectedSportType, function ($q) {
//                $q->whereHas('sportTypes', $this->selectedSportType);
//            })
            ->when($this->selectedSportType, function ($q) {
                $q->whereHas('sportTypes', function ($query) {
                    $query->where('sport_types.id', $this->selectedSportType);
                });
            })
            ->orderBy('date', $this->sortDirection)
            ->paginate($this->perPage)
            ->withQueryString();

        //        $events = News::distinct()->whereNotNull('event_id')->pluck('event_id');
        //        $athletes = News::distinct()->whereNotNull('athlete_id')->pluck('athlete_id');

//        $events = \App\Models\Event::whereHas('news')
//            ->orderBy('title')->pluck('title', 'id');
//        $athletes = \App\Models\Athlete::whereHas('news')
//            ->orderBy('last_name')->pluck('last_name', 'id');

// Список событий, связанных с новостями выбранного вида спорта
        $events = \App\Models\Event::whereHas('news')
            ->when($this->selectedSportType, function ($query) {
                $query->whereHas('news', function ($q) {
                    $q->whereHas('sportTypes', function ($qq) {
                        $qq->where('sport_types.id', $this->selectedSportType);
                    });
                });
            })
            ->when($this->selectedAthlete, function ($query) {
                $query->whereHas('news', function ($q) {
                    $q->where('athlete_id', $this->selectedAthlete);
                });
            })
            ->orderBy('title')
            ->pluck('title', 'id');

// Список атлетов, связанных с новостями выбранного вида спорта
        $athletes = \App\Models\Athlete::whereHas('news')
            ->when($this->selectedSportType, function ($query) {
                $query->whereHas('news', function ($q) {
                    $q->whereHas('sportTypes', function ($qq) {
                        $qq->where('sport_types.id', $this->selectedSportType);
                    });
                });
            })
            ->when($this->selectedEvent, function ($query) {
                $query->whereHas('news', function ($q) {
                    $q->where('event_id', $this->selectedEvent);
                });
            })
            ->orderBy('last_name')
            ->pluck('last_name', 'id');

        $sport_types = \App\Models\SportType::whereHas('news')
            ->when($this->selectedAthlete, function ($query) {
                $query->whereHas('news', function ($q) {
                    $q->where('athlete_id', $this->selectedAthlete);
                });
            })
            ->when($this->selectedEvent, function ($query) {
                $query->whereHas('news', function ($q) {
                    $q->where('event_id', $this->selectedEvent);
                });
            })
            ->orderBy('name')->pluck('name', 'id');


        return view('livewire.news.listing', [
            'news' => $news,
            'events' => $events,
            'athletes' => $athletes,
            'sport_types' => $sport_types,
//            'user' => $user,
        ]);
    }

    public function toggleSort()
    {
        $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        $this->resetPage();
//        $this->goToNewsList();
    }


    public function updatedSelectedEvent()
    {
        $this->resetPage();
//        $this->goToNewsList();
    }

    public function updatedSelectedAthlete()
    {
        $this->resetPage();
//        $this->goToNewsList();
    }
    public function updatedSelectedSportType()
    {
        $this->resetPage();
    }


//    public function goToNewsList()
//    {
//        return redirect()->route('news', [
//            'page' => 1,
//            'sortDirection' => $this->sortDirection,
//            'selectedEvent' => $this->selectedEvent,
////    public $selectedEvent = '';
//            'selectedAthlete' => $this->selectedAthlete,
////    public $selectedAthlete = '';
//        ]);
//    }
}
