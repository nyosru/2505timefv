<?php

namespace App\Livewire\EventAdm;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Event;
use App\Models\SportType;
use App\Models\Country;
use App\Models\City;

class EventCrud extends Component
{
    use WithPagination, WithFileUploads;

    public $title;
    public $event_date;
    public $events_date_finished;
    public $description;
    public $photo;
    public $sport_type_id;
    public $country_id;
    public $city_id;

    public $currentEvent = null;
    public $editMode = false;
    public $showForm = false;
    public $perPage = 10;
    public $search = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'event_date' => 'required|date',
        'events_date_finished' => 'nullable|date|after:event_date',
        'description' => 'nullable|string',
        'photo' => 'nullable|image|max:2048',
        'sport_type_id' => 'required|exists:sport_types,id',
        'country_id' => 'required|exists:countries,id',
        'city_id' => 'required|exists:cities,id',
    ];

    public function render()
    {
        $events = Event::with(['sportType', 'country', 'city'])
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.event-adm.event-crud', [
            'events' => $events,
            'sportTypes' => SportType::all(),
            'countries' => Country::all(),
            'cities' => City::all(),
        ]);
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showForm = true;
    }

    public function edit(Event $event)
    {
        $this->currentEvent = $event;
        $this->editMode = true;
        $this->showForm = true;

        $this->title = $event->title;
        $this->event_date = $event->event_date->format('Y-m-d');
        $this->events_date_finished = $event->events_date_finished?->format('Y-m-d');
        $this->description = $event->description;
        $this->sport_type_id = $event->sport_type_id;
        $this->country_id = $event->country_id;
        $this->city_id = $event->city_id;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'event_date' => $this->event_date,
            'events_date_finished' => $this->events_date_finished,
            'description' => $this->description,
            'sport_type_id' => $this->sport_type_id,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('events', 'public');
        }

        if ($this->editMode) {
            $this->currentEvent->update($data);
            session()->flash('success', 'Мероприятие обновлено');
        } else {
            Event::create($data);
            session()->flash('success', 'Мероприятие создано');
        }

        $this->resetForm();
    }

    public function delete(Event $event)
    {
        $event->delete();
        session()->flash('success', 'Мероприятие удалено');
    }

    private function resetForm()
    {
        $this->reset([
            'title', 'event_date', 'events_date_finished',
            'description', 'photo', 'sport_type_id',
            'country_id', 'city_id', 'currentEvent', 'editMode', 'showForm'
        ]);
        $this->resetErrorBag();
    }
}