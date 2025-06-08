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
    public $urls;
    public $link;

    protected $rules = [
//        'name' => 'required|string|max:255',
        'name' => 'nullable|string|max:255',
        'urls' => 'nullable|string',
        'link' => 'nullable|string',
//        'file' => 'required|file|max:10240', // max 10MB, настройте по необходимости
        'files.*' => 'nullable|file|max:10240', // проверка для каждого файла
        'type' => 'required|in:image,video,document,publication',
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
        $this->reset([
            'attachments',
            'name',
            'link',
            'file',
            'files'
//            , 'type'
        ]);
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

    public function scanSaveVideoUrls()
    {

        $array_url = explode("\n", $this->urls);
//        dd($this->getAttributes());
//        dd($array_url);

        foreach ($array_url as $url) {

            if (!empty($url)) {
//                https://vkvideo.ru/video-157335818_456246397
                $vkService = new \App\Http\Services\VkVideoService(env('VK_ACCESS_TOKEN'));
                $videoId = '-123456_78901234'; // owner_id и video_id через подчёркивание
                $vkService->parsingVideoUrl($url);
                $previewUrl = $vkService->getVideoPreviewUrl($videoId);

                dd([$url, $previewUrl]);
            }

            EventAttachment::create([
                'event_id' => $this->eventId,
//                'name' => $this->name,
//                'filename' => $file->getClientOriginalName(),
                'url_video' => $url,
                'type' => $this->type,
            ]);
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

        if ($this->type == 'video') {

            $this->scanSaveVideoUrls();

        } elseif ($this->type == 'publication') {

//            dd(121212);

            if (!empty($this->link)) {

                EventAttachment::create([
                    'event_id' => $this->eventId,
                    'name' => $this->name,
//                    'filename' => $file->getClientOriginalName(),
//                    'url' => $path,
                    'type' => $this->type,
                    'link' => $this->link,
                ]);

            } else {
                foreach ($this->files as $file) {
                    $path = $file->store('event_attachments', 'public');

                    EventAttachment::create([
                        'event_id' => $this->eventId,
                        'name' => $this->name,
                        'filename' => $file->getClientOriginalName(),
                        'url' => $path,
                        'type' => $this->type,
//                        'link' => $this->link,
                    ]);
                }
            }

        } else {

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
        }

        $this->reset([
            'urls',
            'files'
//            'name'
//            , 'file'
//            , 'type'
        ]);

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
