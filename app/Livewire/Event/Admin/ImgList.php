<?php

namespace App\Livewire\Event\Admin;

use Livewire\Component;

use App\Models\EventAttachment;
use Livewire\Attributes\On;

class ImgList extends Component
{

    public int $eventId;

    public $photos = [];

    protected $listeners = [
        'photoAdded' => 'refreshPhotos',
    ];

    public function mount(int $eventId)
    {
        $this->eventId = $eventId;
        $this->loadPhotos();
    }

    public function loadPhotos()
    {
        $this->photos = EventAttachment::where('event_id', $this->eventId)
            ->where('type', 'image')
            ->orderByDesc('created_at')
            ->get();
    }

//    public function refreshPhotos()
//    {
//        $this->loadPhotos();
//    }
    #[On('photoAdded')]
    public function refreshPhotos(array $payload)
    {
        // Опционально: проверить, что событие принадлежит нужному мероприятию
        if (isset($payload['eventId']) && $payload['eventId'] == $this->eventId) {
            $this->loadPhotos();
        }
    }

    public function deletePhoto($id)
    {
        $photo = \App\Models\EventAttachment::find($id);
        if ($photo) {
            // Удаляем сам файл из хранилища
            \Storage::disk('public')->delete($photo->url);

            // Удаляем запись
            $photo->delete();

            $this->loadPhotos();
        }
    }

    public function render()
    {
        return view('livewire.event.admin.img-list');
    }
}
