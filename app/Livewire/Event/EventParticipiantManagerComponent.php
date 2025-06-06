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
    public $event_group_nagrada_id;

    public $events = [];
    public $athletes = [];
    public $participants = [];
    public $groups = [];

    protected $rules = [
        'eventId' => 'required|exists:events,id',
        'athleteId' => 'required|exists:athletes,id',
        'event_group_nagrada_id' => 'nullable|exists:event_group_nagradas,id',
        'place' => 'nullable|integer|in:1,2,3',
    ];

    protected $listeners = [
        'groupsUpdated' => 'refreshGroups',
//        'participtianRefresh' => 'LoadData',
//        'participtianRefresh' => 'refreshView',
    ];

//    public function refreshView(){
//        $this->updatedEventId($this->eventId);
//    }
    public function refreshGroups()
    {
        // Логика обновления списка групп, например, загрузка из базы
        $this->LoadData();
//        $this->updatedEventId();
    }

    public function mount()
    {
       $this->LoadData();
    }

    public function loadData()
    {
        $this->events = Event::with([
            'groupsNagrada'
        ])->orderBy('title')->get();
//        $this->athletes = collect();
        $this->athletes = Athlete::orderBy('last_name')->get();
//        $this->participants = collect();
        if (!empty($this->eventId)) {
            $this->updatedEventId($this->eventId);
        }
    }

    public function updatedEventId($value)
    {

//        dd($this->events->find($value)->groupsNagrada->toArray());

        // Загрузить участников данного мероприятия
        $this->participants = EventParticipant::with(['athlete', 'eventGroupNagrada'
        ])
            ->where('event_id', $value)
//            ->orderBy('event_group_nagrada_id', 'ASC')
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
            'event_group_nagrada_id' => $this->event_group_nagrada_id ?: null,
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
