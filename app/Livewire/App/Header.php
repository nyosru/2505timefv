<?php

namespace App\Livewire\App;

//use App\Models\User;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {

//        $user = User::with('roles')->all();
//        dd($user);

        return view('livewire.app.header');
    }
}
