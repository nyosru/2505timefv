<?php

namespace App\Livewire\Athlete;

use App\Models\Athlete;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
//    public function render()
//    {
//        return view('livewire.athlete.admin');
//    }
    use WithPagination;

    public $selectedAthleteId = null;
    public $showForm = false;

    protected $listeners = [
        'athleteSaved' => 'onAthleteSaved',
        'closeForm' => 'closeForm',
    ];

    public function render()
    {
        $athletes = Athlete::orderBy('last_name')->paginate(10);

        return view('livewire.athlete.admin', compact('athletes'));
    }

    public function create()
    {
        $this->selectedAthleteId = null;
        $this->showForm = true;
        $this->emit('openForm', null);
    }

    public function edit($id)
    {
        $this->selectedAthleteId = $id;
        $this->showForm = true;
        $this->emit('openForm', $id);
    }

    public function delete($id)
    {
        $athlete = Athlete::findOrFail($id);
        $athlete->delete();
        session()->flash('success', 'Спортсмен удалён');
    }

    public function onAthleteSaved()
    {
        $this->showForm = false;
        $this->resetPage();
        session()->flash('success', 'Спортсмен сохранён');
    }

    public function closeForm()
    {
        $this->showForm = false;
    }
}
