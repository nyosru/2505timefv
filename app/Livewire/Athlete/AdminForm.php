<?php

namespace App\Livewire\Athlete;

use App\Models\Athlete;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminForm extends Component
{
    use WithFileUploads;

    public ?int $athleteId = null;

    public $last_name;
    public $first_name;
    public $middle_name;
    public $birth_date;
    public $photo;
    public $photoPreview;

    protected function rules()
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    protected $listeners = ['openForm'];

    public function mount()
    {
        if ($this->athleteId) {
            $this->loadAthlete();
        }
    }

    public function openForm($id = null)
    {
        $this->resetValidation();
        $this->reset(['last_name', 'first_name', 'middle_name', 'birth_date', 'photo', 'photoPreview']);
        $this->athleteId = $id;

        if ($id) {
            $this->loadAthlete();
        }
    }

    public function loadAthlete()
    {
        $athlete = Athlete::findOrFail($this->athleteId);

        $this->last_name = $athlete->last_name;
        $this->first_name = $athlete->first_name;
        $this->middle_name = $athlete->middle_name;
        $this->birth_date = $athlete->birth_date ? $athlete->birth_date->format('Y-m-d') : null;
        $this->photoPreview = $athlete->photo ? asset('storage/' . $athlete->photo) : null;
    }

    public function updatedPhoto()
    {
        $this->validateOnly('photo');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'birth_date' => $this->birth_date,
        ];

        if ($this->photo) {
            $path = $this->photo->store('athletes', 'public');
            $data['photo'] = $path;
        }

        if ($this->athleteId) {
            $athlete = Athlete::findOrFail($this->athleteId);
            $athlete->update($data);
            session()->flash('success', 'Спортсмен успешно отредактирован.');
        } else {
            Athlete::create($data);
            session()->flash('success', 'Спортсмен успешно сохранен.');

        }

//        $this->emitUp('athleteSaved');
//        $this->emit('closeForm');
    }

    public function cancel()
    {
//        $this->emit('closeForm');
    }


    public function render()
    {
        return view('livewire.athlete.admin-form');
    }
}
