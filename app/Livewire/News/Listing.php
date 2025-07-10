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

    protected $queryString = [
        'sortDirection' => ['except' => 'desc'],
        'selectedEvent' => ['except' => ''],
        'selectedAthlete' => ['except' => ''],
    ];

    public function render()
    {

//        $user = User::with([
//            'roles',
//            'roles.permissions'
//        ])->get();


        $news = News::query()
            ->when($this->selectedEvent, fn($q) => $q->where('event_id', $this->selectedEvent))
            ->when($this->selectedAthlete, fn($q) => $q->where('athlete_id', $this->selectedAthlete))
            ->orderBy('date', $this->sortDirection)
            ->paginate($this->perPage)
            ->withQueryString()
        ;

        $events = News::distinct()->whereNotNull('event_id')->pluck('event_id');
        $athletes = News::distinct()->whereNotNull('athlete_id')->pluck('athlete_id');

        return view('livewire.news.listing', [
            'news' => $news,
            'events' => $events,
            'athletes' => $athletes,
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
