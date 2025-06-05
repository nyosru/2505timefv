<?php

namespace App\Livewire\Event;

use App\Models\Athlete;
use App\Models\Event;
use App\Models\EventParticipant;
use Livewire\Component;

class EventParticipiantManagerComponent extends Component
{

    public $eventId;
    public $athleteId;
    public $place;

    public $events = [];
    public $athletes = [];
    public $participants = [];

    protected $rules = [
        'eventId' => 'required|exists:events,id',
        'athleteId' => 'required|exists:athletes,id',
        'place' => 'nullable|integer|in:1,2,3',
    ];

    public function mount()
    {
        $this->events = Event::orderBy('title')->get();
//        $this->athletes = collect();
        $this->athletes = Athlete::orderBy('last_name')->get();
//        $this->participants = collect();
        if (!empty($this->eventId)) {
            $this->updatedEventId($this->eventId);
        }
    }

    public function updatedEventId($value)
    {
        // Загрузить участников данного мероприятия
        $this->participants = EventParticipant::with('athlete')
            ->where('event_id', $value)
            ->orderByRaw('place IS NULL, place ASC')
            ->get();

        // Загрузить спортсменов, которые еще не привязаны к этому мероприятию
        $attachedAthleteIds = $this->participants->pluck('athlete_id')->toArray();
        $this->athletes = Athlete::whereNotIn('id', $attachedAthleteIds)
            ->orderBy('last_name')
            ->get();

        // Сбросить выбранного спортсмена
        $this->athleteId = null;
    }

    public function addParticipant()
    {
        $this->validate();

        // Проверка, что спортсмен еще не привязан (на всякий случай)
        $exists = EventParticipant::where('event_id', $this->eventId)
            ->where('athlete_id', $this->athleteId)
            ->exists();

        if ($exists) {
            session()->flash('error', 'Этот спортсмен уже привязан к мероприятию.');
            return;
        }

        EventParticipant::create([
            'event_id' => $this->eventId,
            'athlete_id' => $this->athleteId,
            'place' => $this->place ?: null,
        ]);

        session()->flash('success', 'Спортсмен успешно добавлен.');

        // Обновить список участников и доступных спортсменов
        $this->updatedEventId($this->eventId);

        // Сброс полей формы
        $this->athleteId = null;
        $this->place = null;
    }

    public function removeParticipant($participantId)
    {
        $participant = EventParticipant::find($participantId);
        if ($participant) {
            $participant->delete();
            session()->flash('success', 'Связь удалена.');
            $this->updatedEventId($this->eventId);
        }
    }

    public function render()
    {
        return view('livewire.event.event-participiant-manager-component');
    }
}
