<?php

namespace App\Livewire\DataIn;

use App\Models\City;
use App\Models\SportPlace;
use Livewire\Component;
use Livewire\WithPagination;

class SportPlaceCrud extends Component
{
    use WithPagination;

    public $name;
    public $city_id;
    public $photo;         // для загрузки локального фото (если нужно)
    public $photo_s3_url;  // ссылка на S3
    public $selectedId = null;
    public $updateMode = false;

    protected $paginationTheme = 'bootstrap'; // или 'tailwind'

    protected $rules = [
        'name' => 'required|string|max:255',
        'city_id' => 'required|exists:cities,id',
        'photo' => 'nullable|string|max:255',
        'photo_s3_url' => 'nullable|url|max:255',
    ];

    public function render()
    {
        $sportPlaces = SportPlace::with('city')->orderBy('name')->paginate(10);
        $cities = City::orderBy('name')->get();

        return view('livewire.data-in.sport-place-crud', compact('sportPlaces', 'cities'));
    }

    public function resetInputFields()
    {
        $this->name = null;
        $this->city_id = null;
        $this->photo = null;
        $this->photo_s3_url = null;
        $this->selectedId = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();

        SportPlace::create([
            'name' => $this->name,
            'city_id' => $this->city_id,
            'photo' => $this->photo,
            'photo_s3_url' => $this->photo_s3_url,
        ]);

        session()->flash('message', 'Спортивное место успешно создано.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $sportPlace = SportPlace::findOrFail($id);
        $this->selectedId = $id;
        $this->name = $sportPlace->name;
        $this->city_id = $sportPlace->city_id;
        $this->photo = $sportPlace->photo;
        $this->photo_s3_url = $sportPlace->photo_s3_url;
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
            $sportPlace = SportPlace::findOrFail($this->selectedId);
            $sportPlace->update([
                'name' => $this->name,
                'city_id' => $this->city_id,
                'photo' => $this->photo,
                'photo_s3_url' => $this->photo_s3_url,
            ]);

            session()->flash('message', 'Спортивное место успешно обновлено.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        $sportPlace = SportPlace::findOrFail($id);
        $sportPlace->delete();

        session()->flash('message', 'Спортивное место успешно удалено.');
    }
}
