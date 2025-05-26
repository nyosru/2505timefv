<?php

namespace App\Livewire\DataIn;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class CityCrudComponent extends Component
{

    use WithPagination;

    public $name;
    public $country_id;
    public $selectedId = null;
    public $updateMode = false;

//    protected $paginationTheme = 'bootstrap'; // или 'tailwind'

    protected $rules = [
        'name' => 'required|string|max:255',
        'country_id' => 'required|exists:countries,id',
    ];


    public function resetInputFields()
    {
        $this->name = null;
        $this->country_id = null;
        $this->selectedId = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();

        City::create([
            'name' => $this->name,
            'country_id' => $this->country_id,
        ]);

        session()->flash('message', 'Город успешно создан.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        $this->selectedId = $id;
        $this->name = $city->name;
        $this->country_id = $city->country_id;
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
            $city = City::findOrFail($this->selectedId);
            $city->update([
                'name' => $this->name,
                'country_id' => $this->country_id,
            ]);

            session()->flash('message', 'Город успешно обновлён.');
//            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        session()->flash('message', 'Город успешно удалён.');
    }


    public function render()
    {
        $cities = City::with('country')->
        orderBy('name')->
        paginate(10);
        $countries = Country::orderBy('name')->get();

        return view('livewire.data-in.city-crud-component'
            , compact('cities', 'countries'));
    }


}
