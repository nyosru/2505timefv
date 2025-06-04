<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;

    public $selectedEventId = null;
    public $showForm = false;

    protected $listeners = [
        'eventSaved' => 'onEventSaved',
        'closeForm' => 'closeForm',
    ];

    public function render()
    {
        $events = Event::orderByDesc('event_date')->paginate(10);

        return view('livewire.event.admin', compact('events'));
    }

    public function create()
    {
        $this->selectedEventId = null;
        $this->showForm = true;
//        $this->emit('openForm', null);
    }

    public function edit($id)
    {
        $this->selectedEventId = $id;
        $this->showForm = true;
//        $this->emit('openForm', $id);
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        session()->flash('success', 'Мероприятие удалено');
    }

    public function onEventSaved()
    {
        $this->showForm = false;
        $this->resetPage();
        session()->flash('success', 'Мероприятие сохранено');
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

//    public function render()
//    {
//        return view('livewire.event.admin');
//    }
}
