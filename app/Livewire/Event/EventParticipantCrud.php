<?php

namespace App\Livewire\Event;

use App\Models\Athlete;
use App\Models\Event;
use App\Models\EventParticipant;
use Livewire\Component;
use Livewire\WithPagination;

class EventParticipantCrud extends Component
{
    use WithPagination;

    public $athlete_id;
    public $event_id;
    public $place = 0;
    public $selectedId = null;
    public $updateMode = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'athlete_id' => 'required|exists:athletes,id',
        'event_id' => 'required|exists:events,id',
        'place' => 'required|integer|min:0',
    ];

    public function render()
    {
        $participants = EventParticipant::with(['athlete', 'event'])->orderBy('id', 'desc')->paginate(10);
        $athletes = Athlete::orderBy('last_name')->get();
        $events = Event::orderBy('event_date', 'desc')->get();

        return view('livewire.event.event-participant-crud', compact('participants', 'athletes', 'events'));
    }


    public function resetInputFields()
    {
        $this->athlete_id = null;
        $this->event_id = null;
        $this->place = 0;
        $this->selectedId = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();

        EventParticipant::create([
            'athlete_id' => $this->athlete_id,
            'event_id' => $this->event_id,
            'place' => $this->place,
        ]);

        session()->flash('message', 'Участник успешно добавлен.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $participant = EventParticipant::findOrFail($id);
        $this->selectedId = $id;
        $this->athlete_id = $participant->athlete_id;
        $this->event_id = $participant->event_id;
        $this->place = $participant->place;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate();

        if ($this->selectedId) {
            $participant = EventParticipant::findOrFail($this->selectedId);
            $participant->update([
                'athlete_id' => $this->athlete_id,
                'event_id' => $this->event_id,
                'place' => $this->place,
            ]);

            session()->flash('message', 'Участник успешно обновлён.');

            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        $participant = EventParticipant::findOrFail($id);
        $participant->delete();

        session()->flash('message', 'Участник успешно удалён.');
    }

}
