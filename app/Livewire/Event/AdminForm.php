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
    public $events_date_finished;

    public $event;

    public $country_id;
    public $city_id;
    public $sport_place_id;

    public $description;
    public $photo;
    public $photoPreview;


    public $countries = [];
    public $cities = [];
    public $sport_places = [];

    public $sport_type_ids = [];

    protected function rules()
    {
        return [

            'title' => 'required|string|max:255',

            'event_date' => 'required|date',
            'events_date_finished' => 'nullable|date',

//            'country_id' => 'required|exists:countries,id',
//            'city_id' => 'required|exists:cities,id',
            'sport_place_id' => 'required|exists:sport_places,id',

            'sport_type_ids' => 'nullable|array',
            'sport_type_ids.*' => 'integer|exists:sport_types,id',

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

            $event = Event::
//            with([
//                'groupsNagrada' => function ($query) {
//                    $query->with(['athletes' => function ($query) {
//                        $query->orderByRaw('place IS NULL, place ASC');
//                    }]);
//                },
//            ])
            with(['groupsNagrada.athletes', 'sportTypes'])
                ->findOrFail($id);

            $this->sport_type_ids = $event->sportTypes->pluck('id')->toArray();

            $this->title = $event->title;
            $this->event_date = $event->event_date->format('Y-m-d');

            $this->events_date_finished = !empty($event->events_date_finished) ? $event->events_date_finished->format('Y-m-d') : null;

//            $this->country = $event->country;
//            $this->city = $event->city;
//            $this->venue = $event->venue;

            $this->country_id = $event->country_id;
            $this->city_id = $event->city_id;
            $this->sport_place_id = $event->sport_place_id ?? null;

            $this->description = $event->description;
            $this->photoPreview = $event->photo ? asset('storage/' . $event->photo) : null;


//            $this->loadCities();
            $this->loadSportPlace();
        } else {
//            $this->cities = [];
//            $this->loadingStartData();
            $this->loadSportPlace();

        }
    }

    public function loadingStartData()
    {
        $e1 = Country::with(['city', 'city.place'])
            ->get();
        echo '<pre class="max-h-[200px] overflow-auto text-xs">', print_r($e1->toArray()), '</pre>';

        try {
            $e1 = Country::where('name', 'Россия')
                ->select('id')
                ->firstOrFail();
            $this->country_id = $e1->id;

            $this->loadCities();

            try {
                $e2 = City::where('name', 'Тюмень')
                    ->where('country_id', $e1->id)
                    ->select('id')
                    ->firstOrFail();
                $this->city_id = $e2->id;

            } catch (\Exception $e) {
            }
        } catch (\Exception $e) {
        }
    }

    public function updatedCountryId()
    {
        $this->city_id = null;
        $this->sport_place_id = null;
        $this->loadCities();
        $this->sport_places = [];
    }

    public function updatedCityId()
    {
        \Debugbar::addMessage('Запрос на спортзалы выполнен', 'info');
        $this->sport_place_id = null;
        $this->loadSportPlace();
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

    protected function loadSportPlace()
    {
        $this->sport_places = SportPlace::query()
            ->join('cities', 'sport_places.city_id', '=', 'cities.id')
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            ->with([
                'city' => function ($query) {
                    $query->select(['id', 'name', 'country_id']);
                },
                'city.country' => function ($query) {
                    $query->select(['id', 'name']);
                }
            ])
            ->orderBy('countries.name')          // Сначала по стране
            ->orderBy('cities.name')             // Потом по городу
            ->orderBy('sport_places.name')       // И, наконец, по имени
            ->select('sport_places.*')           // Чтобы не выбирать поля из других таблиц
            ->get();

//        $e = $this->sport_places->toArray();
//        usort( $e, function ($a, $b) {
//            $keyA = $a['city']['country']['name'] . '/' . $a['city']['name'] . '/' . $a['name'];
//            $keyB = $b['city']['country']['name'] . '/' . $b['city']['name'] . '/' . $b['name'];
//
//            return strcmp($keyA, $keyB);
//        });
//        $this->sport_places = $e;

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
            'city_id' => $this->city_id,
            'sport_place_id' => $this->sport_place_id,

            'description' => $this->description,
        ];

        if (!empty($this->events_date_finished)) {
            $data['events_date_finished'] = $this->events_date_finished;
        }

        if ($this->photo) {
            $path = $this->photo->store('events', 'public');
            $data['photo'] = $path;
        }

        if ($this->id) {
            $event = Event::findOrFail($this->id);
            $event->update($data);
            $event->sportTypes()->sync($this->sport_type_ids);
            session()->flash('success', 'Мероприятие успешно сохранено.');
            return redirect()->route('admin.events');
        } else {
            $event = Event::create($data);
            $event->sportTypes()->sync($this->sport_type_ids);
            session()->flash('successEvent', 'Мероприятие успешно сохранено, добавьте фото и видео');
            return redirect()->route('admin.events.form', ['id' => $event->id]);
        }

    }

    public function render()
    {
        return view('livewire.event.admin-form');
    }
}
