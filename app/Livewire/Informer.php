<?php

namespace App\Livewire;

use App\Http\Controllers\UserController;
use App\Models\User;
use Livewire\Component;

class Informer extends Component
{
    public $ar1;

    public function render()
    {

//        UserController::checkRolesAndSetRoleOne();

        try {
            $user_id = auth()->user()->id;
//            dd(auth()->user()->toArray());
            $this->ar1 = User::whereId($user_id)
                ->with([
                    'boardUser',
                    'currentBoard',
                    'invitations',
                    'roles',
//                    'role'
                ])->first();
        } catch (\Exception $e) {
        }

        return view('livewire.informer');
    }
}
