<?php

namespace App\Livewire\Event;

use App\Models\EventParticipant;
use Livewire\Component;

class EventParticipiantItem extends Component
{
    public $participant;


    public function removeParticipant($participantId)
    {
        $participant = EventParticipant::find($participantId);
        if ($participant) {
            $participant->delete();
            session()->flash('success', 'Связь удалена.');
//            $this->updatedEventId($this->eventId);
            $this->dispatch('participtianRefresh');
        }
    }

    public function render()
    {
        return view('livewire.event.event-participiant-item');
    }
}
