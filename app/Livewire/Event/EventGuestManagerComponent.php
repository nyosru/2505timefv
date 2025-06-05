<?php

namespace App\Livewire\Event;

use App\Models\Athlete;
use App\Models\Event;
use App\Models\EventGuest;
use App\Models\EventParticipant;
use App\Models\Guest;
use Livewire\Component;

class EventGuestManagerComponent extends Component
{
    public ?int $eventId = null;
    public ?int $guestId = null;

    public $events = [];
    public $guests = [];
    public $eventGuests = [];

    protected $rules = [
        'eventId' => 'required|exists:events,id',
        'guestId' => 'required|exists:guests,id',
    ];

    public function mount($eventId = null)
    {
        $this->events = Event::orderBy('title')->get();

        if ($eventId) {
            $this->eventId = $eventId;
            $this->loadEventGuests();
            $this->loadGuests();
        } else {
            $this->guests = [];
            $this->eventGuests = [];
        }
    }

    public function updatedEventId()
    {
        $this->guestId = null;
        $this->loadEventGuests();
        $this->loadGuests();
    }

    protected function loadEventGuests()
    {
        if ($this->eventId) {
            $this->eventGuests = EventGuest::with('guest')
                ->where('event_id', $this->eventId)
                ->get();
        } else {
            $this->eventGuests = collect();
        }
    }

    protected function loadGuests()
    {
        if ($this->eventId) {
            $attachedGuestIds = EventGuest::where('event_id', $this->eventId)
                ->pluck('guest_id')
                ->toArray();

            $this->guests = Guest::whereNotIn('id', $attachedGuestIds)
                ->orderBy('last_name')
                ->get();
        } else {
            $this->guests = collect();
        }
    }

    public function addGuest()
    {
        $this->validate();

        // Проверка, что гость еще не привязан
        $exists = EventGuest::where('event_id', $this->eventId)
            ->where('guest_id', $this->guestId)
            ->exists();

        if ($exists) {
            session()->flash('error', 'Этот гость уже привязан к мероприятию.');
            return;
        }

        EventGuest::create([
            'event_id' => $this->eventId,
            'guest_id' => $this->guestId,
        ]);

        session()->flash('success', 'Гость успешно добавлен.');

        $this->guestId = null;
        $this->loadEventGuests();
        $this->loadGuests();
    }

    public function removeGuest($id)
    {
        $eventGuest = EventGuest::find($id);
        if ($eventGuest) {
            $eventGuest->delete();
            session()->flash('success', 'Гость удалён из мероприятия.');
            $this->loadEventGuests();
            $this->loadGuests();
        }
    }

    public function render()
    {
        return view(
              'livewire.event.event-guest-manager-component'
            , [
            'events' => $this->events,
            'guests' => $this->guests,
            'eventGuests' => $this->eventGuests,
        ]);
    }
}
