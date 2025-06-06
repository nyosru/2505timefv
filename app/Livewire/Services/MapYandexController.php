<?php

namespace App\Livewire\Services;

use Livewire\Component;

class MapYandexController extends Component
{
    public string $address = 'Тюмень, ул. Республики 1';

    public function render()
    {
        return view('livewire.services.map-yandex-controller');
    }
}
