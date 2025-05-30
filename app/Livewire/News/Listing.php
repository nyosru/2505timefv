<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortDirection = 'desc';
    public $selectedEvent = '';
    public $selectedAthlete = '';

    protected $queryString = [
        'sortDirection' => ['except' => 'desc'],
        'selectedEvent' => ['except' => ''],
        'selectedAthlete' => ['except' => ''],
    ];

    public function render()
    {
        $news = News::query()
            ->when($this->selectedEvent, fn($q) => $q->where('event_id', $this->selectedEvent))
            ->when($this->selectedAthlete, fn($q) => $q->where('athlete_id', $this->selectedAthlete))
            ->orderBy('date', $this->sortDirection)
            ->paginate($this->perPage);

        $events = News::distinct()->whereNotNull('event_id')->pluck('event_id');
        $athletes = News::distinct()->whereNotNull('athlete_id')->pluck('athlete_id');

        return view('livewire.news.listing', [
            'news' => $news,
            'events' => $events,
            'athletes' => $athletes,
        ]);
    }

    public function toggleSort()
    {
        $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        $this->resetPage();
    }

    public function updatedSelectedEvent()
    {
        $this->resetPage();
    }

    public function updatedSelectedAthlete()
    {
        $this->resetPage();
    }
}
