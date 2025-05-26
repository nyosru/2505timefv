<?php

namespace App\Livewire\Athlete;

use App\Models\Athlete;
use Livewire\Component;

class Show extends Component
{
    public Athlete $athlete;

    public function mount($id)
    {
        $this->athlete = Athlete::findOrFail($id);
    }


    public function render()
    {
        return view('livewire.athlete.show');
    }
}
