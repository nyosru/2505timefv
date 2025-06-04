<?php

namespace App\Livewire\Event;

use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\SportPlace;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminForm extends Component
{
    use WithFileUploads;

    public ?int $id = null; // id из маршрута

    public $title;
    public $event_date;

    public $country_id;
    public $city_id;
    public $sport_place_id;

    public $description;
    public $photo;
    public $photoPreview;


    public $countries = [];
    public $cities = [];
    public $venues = [];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',

            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'sport_place_id' => 'required|exists:sport_places,id',

            'description' => 'nullable|string',
//            'photo' => 'nullable|image|max:2048',
            'photo' => 'nullable|image',
        ];
    }

    public function mount($id = null)
    {
        $this->countries = Country::orderBy('name')->get();
        $this->id = $id;

        if ($id) {
            $event = Event::findOrFail($id);

            $this->title = $event->title;
            $this->event_date = $event->event_date->format('Y-m-d');

//            $this->country = $event->country;
//            $this->city = $event->city;
//            $this->venue = $event->venue;

            $this->country_id = $event->country_id;
            $this->city_id = $event->city_id;
            $this->sport_place_id = $event->sport_place_id ?? null;

            $this->description = $event->description;
            $this->photoPreview = $event->photo ? asset('storage/' . $event->photo) : null;


            $this->loadCities();
            $this->loadVenues();
        } else {
            $this->cities = [];
            $this->venues = [];

        }
    }

    public function updatedCountryId()
    {
        $this->city_id = null;
        $this->sport_place_id = null;
        $this->loadCities();
        $this->venues = [];
    }

    public function updatedCityId()
    {
        $this->sport_place_id = null;
        $this->loadVenues();
    }

    protected function loadCities()
    {
        if ($this->country_id) {
            $this->cities = City::where('country_id', $this->country_id)
                ->orderBy('name')
                ->get();
        } else {
            $this->cities = [];
        }
    }

    protected function loadVenues()
    {
        if ($this->city_id) {
            $this->venues = SportPlace::where('city_id', $this->city_id)
                ->orderBy('name')
                ->get();
        } else {
            $this->venues = [];
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
//            'country' => $this->country,
//            'city' => $this->city,
//            'venue' => $this->venue,

            'country_id' => $this->country_id,
            'city_id' =>  $this->city_id,
            'sport_place_id' => $this->sport_place_id,

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
