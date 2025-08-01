<?php

namespace App\Livewire\Event;

use Livewire\Component;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Validation\Rule;
class CompanyParticipantesManager extends Component
{

    public int $eventId;
    public Event $event;

    public $availableOrganizers = [];
    public $selectedOrganizerId = null;


    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $this->loadEvent();
        $this->loadAvailableOrganizers();
    }

    public function loadEvent()
    {
        $this->event = Event::with('companyParticipantes')->findOrFail($this->eventId);
    }

    /**
     * Загружаем организаторов, которых пока нет в связанном списке, чтобы нельзя было добавить дубли.
     */
    public function loadAvailableOrganizers()
    {
        $usedIds = $this->event->companyParticipantes->pluck('id')->toArray();
        $this->availableOrganizers = Organizer::whereNotIn('id', $usedIds)
            ->orderBy('name')
            ->get();
    }

    /**
     * Добавить выбранного организатора
     */
    public function addOrganizer()
    {
        $this->validate([
            'selectedOrganizerId' => [
                'required',
                'integer',
                Rule::exists('organizers', 'id')
            ],
        ]);

        $this->event->companyOrganizators()->attach($this->selectedOrganizerId);

        $this->loadEvent();
        $this->loadAvailableOrganizers();

        // Очистить выбор
        $this->selectedOrganizerId = null;

//        $this->dispatchBrowserEvent('notify', ['message' => 'Организатор успешно добавлен']);
    }

    /**
     * Удалить организатора по id
     */
    public function removeOrganizer($organizerId)
    {
        $this->event->companyParticipantes()->detach($organizerId);

        $this->loadEvent();
        $this->loadAvailableOrganizers();

//        $this->dispatch('notify', ['message' => 'Организатор удалён']);
    }


    public function render()
    {
        return view('livewire.event.company-participantes-manager');
    }
}
