<?php

namespace App\Livewire\App;

use Livewire\Component;

class MenuItem extends Component
{
    public $routeName;
    public $label;
    public $icon;

    public function render()
    {
        return view('livewire.app.menu-item');
    }
}
