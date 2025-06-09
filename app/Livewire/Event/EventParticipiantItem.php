<?php

namespace App\Livewire\Event;

use App\Models\EventParticipant;
use Livewire\Component;

class EventParticipiantItem extends Component
{
    public $participant;
    public $eventId;
    public $show = true;

    public function removeParticipant($participantId)
    {
        $participant = EventParticipant::where('athlete_id',$participantId)->where('event_id',$this->eventId)->first();
        if ($participant) {
            $participant->delete();
            session()->flash('success', 'Связь удалена.');
//            $this->updatedEventId($this->eventId);
//            $this->dispatch('participtianRefresh');
            $this->show = false;
        }
    }

    public function render()
    {
        return view('livewire.event.event-participiant-item');
    }
}
