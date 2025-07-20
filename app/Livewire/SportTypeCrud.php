<?php

namespace App\Livewire;

use App\Models\SportType;
use Livewire\Component;
use Livewire\WithPagination;

class SportTypeCrud extends Component
{
    use WithPagination;

    public $name;
    public $selectedId = null;
    public $updateMode = false;

    protected $paginationTheme = 'bootstrap'; // или 'tailwind' по вашему выбору

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $sportTypes = SportType::orderBy('name')->paginate(100);

        return view('livewire.sport-type-crud', compact('sportTypes'));
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

        SportType::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Вид спорта успешно создан.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $sportType = SportType::findOrFail($id);
        $this->selectedId = $id;
        $this->name = $sportType->name;
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
            $sportType = SportType::findOrFail($this->selectedId);
            $sportType->update([
                'name' => $this->name,
            ]);

            session()->flash('message', 'Вид спорта успешно обновлён.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        $sportType = SportType::findOrFail($id);
        $sportType->delete();

        session()->flash('message', 'Вид спорта успешно удалён.');
    }
}
