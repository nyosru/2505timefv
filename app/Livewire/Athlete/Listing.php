<?php

namespace App\Livewire\Athlete;

use App\Models\Athlete;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function render()
    {
        $athletes = Athlete::orderBy('last_name')->paginate($this->perPage);

        return view('livewire.athlete.listing', [
            'athletes' => $athletes,
        ]);
    }
//    public function render()
//    {
//        return view('livewire.athlete.listing');
//    }
}
