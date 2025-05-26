<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminForm extends Component
{
    use WithFileUploads;

    public ?int $id = null; // id из маршрута

    public $title;
    public $event_date;
    public $country;
    public $city;
    public $venue;
    public $description;
    public $photo;
    public $photoPreview;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    public function mount($id = null)
    {
        $this->id = $id;

        if ($id) {
            $event = Event::findOrFail($id);

            $this->title = $event->title;
            $this->event_date = $event->event_date->format('Y-m-d');
            $this->country = $event->country;
            $this->city = $event->city;
            $this->venue = $event->venue;
            $this->description = $event->description;
            $this->photoPreview = $event->photo ? asset('storage/' . $event->photo) : null;
        }
    }

    public function updatedPhoto()
    {
        $this->validateOnly('photo');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'event_date' => $this->event_date,
            'country' => $this->country,
            'city' => $this->city,
            'venue' => $this->venue,
            'description' => $this->description,
        ];

        if ($this->photo) {
            $path = $this->photo->store('events', 'public');
            $data['photo'] = $path;
        }

        if ($this->id) {
            $event = Event::findOrFail($this->id);
            $event->update($data);
        } else {
            Event::create($data);
        }

        session()->flash('success', 'Мероприятие успешно сохранено.');

        // Перенаправление после сохранения (например, к списку)
        return redirect()->route('admin.events');
    }

    public function render()
    {
        return view('livewire.event.admin-form');
    }
}
