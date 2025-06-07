<?php

namespace App\Livewire\EventAdm;

use App\Models\Event;
use App\Models\EventGroupNagrada;
use Livewire\Component;

class EventGroupNagradaManagerComponent extends Component
{

    public $hideSetEvent = false;
    public $eventId = null;
    public $groupName = null;

    public $events = [];
    public $groups = [];

    public $editingGroupId = null;
    public $editingGroupName = null;

    protected $rules = [
        'eventId' => 'required|exists:events,id',
        'groupName' => 'required|string|max:255',
    ];

    public function mount($eventId = '')
    {
        $this->events = Event::orderBy('title')->get();
        if (!empty($eventId)) {
            $this->eventId = $eventId;
            $this->loadGroups();
        } else {
            $this->groups = collect();
        }
    }


    public function startEditGroup($groupId)
    {
        $group = EventGroupNagrada::find($groupId);
        if ($group) {
            $this->editingGroupId = $group->id;
            $this->editingGroupName = $group->name;
        }
    }

    public function saveGroup()
    {
        $this->validate([
            'editingGroupName' => 'required|string|max:255',
        ]);

        if ($this->editingGroupId) {
            $group = EventGroupNagrada::find($this->editingGroupId);
            if ($group) {
                $group->name = $this->editingGroupName;
                $group->save();

                session()->flash('success', 'Название группы успешно обновлено.');
                $this->loadGroups();

                // Сброс состояния редактирования
                $this->editingGroupId = null;
                $this->editingGroupName = null;

                $this->dispatch('groupsUpdated');
            }
        }
    }

    public function cancelEdit()
    {
        $this->editingGroupId = null;
        $this->editingGroupName = null;
    }


    public
    function updatedEventId($value)
    {
        $this->loadGroups();
        $this->groupName = null;
    }

    public
    function loadGroups()
    {
        if ($this->eventId) {
            $this->groups = EventGroupNagrada::where('event_id', $this->eventId)
                ->orderBy('name')
                ->get();
        } else {
            $this->groups = collect();
        }
    }

    public
    function addGroup()
    {
        $this->validate();

        EventGroupNagrada::create([
            'name' => $this->groupName,
            'event_id' => $this->eventId,
        ]);

        session()->flash('success', 'Группа успешно добавлена.');

        $this->groupName = null;
        $this->loadGroups();

//        $this->emitTo('event-participiant-manager-component', 'groupsUpdated');
//        $this->emit('groupsUpdated');
        $this->dispatch('groupsUpdated');

    }

    public
    function deleteGroup($groupId)
    {
        $group = EventGroupNagrada::find($groupId);
        if ($group) {
            $group->delete();
            session()->flash('success', 'Группа удалена.');
            $this->loadGroups();
//            $this->emitTo('event-participiant-manager-component', 'groupsUpdated');
//            $this->emit('groupsUpdated');
            $this->dispatch('groupsUpdated');
        }

    }

    public
    function render()
    {
        return view('livewire.event-adm.event-group-nagrada-manager-component');
    }

//    public function render()
//    {
//        return view('livewire.event-adm.event-group-nagrada-manager-component');
//    }
}
