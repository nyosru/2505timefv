<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class CountryCrud extends Component
{
    use WithPagination;

    public $name;
    public $selectedId = null;
    public $updateMode = false;

    protected $paginationTheme = 'bootstrap'; // или 'tailwind'

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $countries = Country::orderBy('name')->paginate(10);

        return view('livewire.country-crud', compact('countries'));
    }

    public function resetInputFields()
    {
        $this->name = null;
        $this->selectedId = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();

        Country::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Страна успешно создана.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $this->selectedId = $id;
        $this->name = $country->name;
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
            $country = Country::findOrFail($this->selectedId);
            $country->update([
                'name' => $this->name,
            ]);

            session()->flash('message', 'Страна успешно обновлена.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        session()->flash('message', 'Страна успешно удалена.');
    }
}
