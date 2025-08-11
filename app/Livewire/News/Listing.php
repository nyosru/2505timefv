<?php

namespace App\Livewire\News;

use App\Models\News;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $perPage = 10;
    #[Url()]
    public $sortDirection = 'desc'; // 'desc' — сначала новые, 'asc' — сначала старые
    #[Url()]
    public $selectedEvent = '';
    #[Url()]
    public $selectedAthlete = '';
    #[Url()]
    public $selectedSportType = '';
    #[Url()]
    public $selectedOrganizations = null;


    public $organizerIds;
    public $participantIds;
    public $allUniqueIds;
    public $allOrganizations;

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

    public function mount(){
        $this->loadOrganizers();
    }

    public function loadOrganizers()
    {

        $this->organizerIds = DB::table('news_organizer')
            ->pluck('organizer_id');
        $this->participantIds = DB::table('news_participantes')
            ->pluck('organizer_id');
        $this->allUniqueIds = $this->organizerIds->merge($this->participantIds)->unique()->values();
        $this->allOrganizations = Organizer::whereIn('id', $this->allUniqueIds)
            ->with(['city', 'city.country'])
            ->orderBy('name')
            ->get();

    }

    public function render()
    {
        $news = News::with(['event', 'athlete', 'sportTypes', 'userAutor'])
            ->when($this->selectedEvent, fn($q) => $q->where('event_id', $this->selectedEvent))
            ->when($this->selectedAthlete, fn($q) => $q->where('athlete_id', $this->selectedAthlete))
            ->when($this->selectedSportType, function ($q) {
                $q->whereHas('sportTypes', function ($query) {
                    $query->where('sport_types.id', $this->selectedSportType);
                });
            })
            ->when($this->selectedOrganizations, function ($q) {
                $companyIds = is_array($this->selectedOrganizations) ? $this->selectedOrganizations : [$this->selectedOrganizations];

                // Фильтр по companyAutors или companyParticipantes для любого из указанных id
                $q->where(function ($query) use ($companyIds) {
                    $query->whereHas('companyAutors', function ($q2) use ($companyIds) {
                        $q2->whereIn('organizer_id', $companyIds);
                    })
                        ->orWhereHas('companyParticipantes', function ($q2) use ($companyIds) {
                            $q2->whereIn('organizer_id', $companyIds);
                        });
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




//
//    public function toggleSort()
//    {
//        $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
//        $this->resetPage();
////        $this->goToNewsList();
//    }
//
//
//    public function updatedSelectedEvent()
//    {
//        $this->resetPage();
////        $this->goToNewsList();
//    }
//
//    public function updatedSelectedAthlete()
//    {
//        $this->resetPage();
////        $this->goToNewsList();
//    }
//    public function updatedSelectedSportType()
//    {
//        $this->resetPage();
//    }


    public function updatedSelectedEvent()
    {
        $this->resetPage();
    }

    public function updatedSelectedAthlete()
    {
        $this->resetPage();
    }

    public function updatedSelectedSportType()
    {
        $this->resetPage();
    }

    public function updatedSortDirection()
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
