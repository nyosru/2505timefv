<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Informer extends Component
{
    public $ar1;

    public function render()
    {

        try {
            $user_id = auth()->user()->id;
            $this->ar1 = User::find($user_id)
                ->with([
                    'boardUser',
                    'currentBoard',
                    'invitations'
                ])->first();
        } catch (\Exception $e) {
        }

        return view('livewire.informer');
    }
}
