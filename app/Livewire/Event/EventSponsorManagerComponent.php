<?php

namespace App\Livewire\Event;

use Livewire\Component;
use App\Models\Event;
use App\Models\Sponsor;

class EventSponsorManagerComponent extends Component
{
    public ?int $eventId = null;
    public ?int $sponsorId = null;

    public $events = [];
    public $sponsors = [];
    public $eventSponsors = [];

    protected $rules = [
        'eventId' => 'required|exists:events,id',
        'sponsorId' => 'required|exists:sponsors,id',
    ];

    public function mount($eventId = null)
    {
        $this->events = Event::orderBy('title')->get();

        if ($eventId) {
            $this->eventId = $eventId;
            $this->loadEventSponsors();
            $this->loadSponsors();
        } else {
            $this->sponsors = collect();
            $this->eventSponsors = collect();
        }
    }

    public function updatedEventId()
    {
        $this->sponsorId = null;
        $this->loadEventSponsors();
        $this->loadSponsors();
    }

    protected function loadEventSponsors()
    {
        if ($this->eventId) {
            $this->eventSponsors = Event::find($this->eventId)
                ->sponsors()
                ->orderBy('company_name')
                ->get();
        } else {
            $this->eventSponsors = collect();
        }
    }

    protected function loadSponsors()
    {
        if ($this->eventId) {
            $attachedSponsorIds = Event::find($this->eventId)
                ->sponsors()
                ->pluck('sponsors.id')
                ->toArray();

            $this->sponsors = Sponsor::whereNotIn('id', $attachedSponsorIds)
                ->orderBy('company_name')
                ->get();
        } else {
            $this->sponsors = collect();
        }
    }

    public function addSponsor()
    {
        $this->validate();

        $event = Event::find($this->eventId);

        if ($event->sponsors()->where('sponsor_id', $this->sponsorId)->exists()) {
            session()->flash('error', 'Этот спонсор уже привязан к мероприятию.');
            return;
        }

        $event->sponsors()->attach($this->sponsorId);

        session()->flash('success', 'Спонсор успешно добавлен.');

        $this->sponsorId = null;
        $this->loadEventSponsors();
        $this->loadSponsors();
    }

    public function removeSponsor($sponsorId)
    {
        $event = Event::find($this->eventId);
        if ($event) {
            $event->sponsors()->detach($sponsorId);
            session()->flash('success', 'Спонсор удалён из мероприятия.');
            $this->loadEventSponsors();
            $this->loadSponsors();
        }
    }

    public function render()
    {
        return view('livewire.event.event-sponsor-manager-component', [
            'events' => $this->events,
            'sponsors' => $this->sponsors,
            'eventSponsors' => $this->eventSponsors,
        ]);
    }

}