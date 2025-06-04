<?php

namespace App\Livewire\Event;

use App\Models\Event;
use App\Models\EventAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class EventAttachmentManagerComponent extends Component
{

    use WithFileUploads;

    public ?int $eventId = null;

    public $attachments;
    public $events;

    public $name;
    public $file;
    public $files = [];
    public $type;

    protected $rules = [
//        'name' => 'required|string|max:255',
        'name' => 'nullable|string|max:255',
//        'file' => 'required|file|max:10240', // max 10MB, настройте по необходимости
        'files.*' => 'required|file|max:10240', // проверка для каждого файла
        'type' => 'required|in:image,video,document',
    ];

    public function mount($eventId = null)
    {
        $this->eventId = $eventId;

        if (!$this->eventId) {
            $this->events = Event::orderBy('title')->get();
        }

        $this->loadAttachments();
    }

    public function updatedEventId()
    {
        $this->reset(['attachments', 'name', 'file', 'type']);
        $this->loadAttachments();
    }

    public function loadAttachments()
    {
        if ($this->eventId) {
            $this->attachments = EventAttachment::where('event_id', $this->eventId)->get();
        } else {
            $this->attachments = collect();
        }
    }

    public function save()
    {
        $this->validate();

//        $path = $this->file->store('event_attachments', 'public');

//        EventAttachment::create([
//            'event_id' => $this->eventId,
//            'name' => $this->name,
//            'filename' => $this->file->getClientOriginalName(),
//            's3_url' => $path, // предполагается, что storage настроен на S3 или локально
//            'type' => $this->type,
//        ]);
        foreach ($this->files as $file) {
            $path = $file->store('event_attachments', 'public');

            EventAttachment::create([
                'event_id' => $this->eventId,
                'name' => $this->name,
                'filename' => $file->getClientOriginalName(),
                'url' => $path,
                'type' => $this->type,
            ]);
        }

        $this->reset(['name', 'file', 'type']);
        $this->loadAttachments();

        session()->flash('success', 'Вложение успешно добавлено.');
    }

    public function deleteAttachment($id)
    {
        $attachment = EventAttachment::findOrFail($id);
        $attachment->delete();
        $this->loadAttachments();
        session()->flash('success', 'Вложение удалено.');
    }

    public function render()
    {
        return view('livewire.event.event-attachment-manager-component', [
            'events' => $this->events ?? [],
            'attachments' => $this->attachments ?? [],
        ]);
    }

}
