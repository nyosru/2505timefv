<?php

namespace App\Livewire\Event\Admin;

use Livewire\Component;

use App\Models\Event;
use App\Models\EventAttachment;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class ImgFormAdd extends Component
{

    use WithFileUploads;

    public int $eventId;

    // Массив загруженных фото
    public array $photos = [];

    // Для предпросмотра фотографий можно использовать $photos уже загруженные Livewire файлы

    protected function rules()
    {
        return [
            'photos.*' => 'image|max:5120', // макс 5Мб на каждое фото
        ];
    }

    public function save()
    {
        $this->validate();

        $event = Event::findOrFail($this->eventId);

        foreach ($this->photos as $photo) {
            // Сохраняем файл и получаем путь
            $path = $photo->store('events', 'public');
            $filename = basename($path);

            // Если хотите, вы можете создавать миниатюру тут (через Intervention Image или Spatie)
            // $mini = ...; // Сохраните путь к мини-версии, если требуется

            EventAttachment::create([
                'event_id'  => $event->id,
                'name'      => $photo->getClientOriginalName(),          // оригинальное имя файла
                'filename'  => $filename,                                // только имя файла
                'image_mini'=> null,                                     // сюда путь миниатюры, если делаете
//                'url'       => asset('storage/' . $path),                // прямой URL до оригинального файла
                'url'       => $path,                // прямой URL до оригинального файла
                'url_video' => null,                                     // если это не видео — null
                's3_url'    => null,                                     // если не используете S3 — null
                'type'      => 'image',
                'link'      => null,                                     // если не ссылка а обычное вложение
            ]);
        }

        $this->photos = [];

        // Отправляем событие другим компонентам
        $this->dispatch('photoAdded', ['eventId' => $this->eventId]);
//        $this->dispatchBrowserEvent('notify', ['message' => 'Фото успешно загружены']);
    }


    public function render()
    {
        return view('livewire.event.admin.img-form-add');
    }
}
