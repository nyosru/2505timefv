<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdminForm extends Component
{

    use WithPagination, WithFileUploads;

    public $title;
    public $date;
    public $short_text;
    public $full_text;
    public $event_id;
    public $athlete_id;
    public $sport_type_ids = []; // массив для нескольких видов спорта

    public $photo;

    public $currentNews = null;
    public $editMode = false;
    public $perPage = 15;
    public $search = '';


    // В компоненте добавьте:
    public $events;
    public $athletes;
    public $sport_types;

    public $newsId;


    public function mount($news = null)
    {
        $this->events = \App\Models\Event::pluck('title', 'id');
        $this->athletes = \App\Models\Athlete::pluck('last_name', 'id');
        $this->sport_types = \App\Models\SportType::pluck('name', 'id');

        if ($news) {
            $news = News::find($news);

            $this->currentNews = $news;
            $this->newsId = $news->id;
            $this->title = $news->title;
            $this->date = $news->date->format('Y-m-d');
            $this->short_text = $news->short_text;
            $this->full_text = $news->full_text;
            $this->event_id = $news->event_id;
            $this->athlete_id = $news->athlete_id;

            // Важно: загружаем связанные виды спорта как массив ID
//            $this->sport_type_ids = $news->sportTypes()->pluck('id')->toArray();
            $this->sport_type_ids = $news->sportTypes()->pluck('sport_types.id')->toArray();

            $this->editMode = true;
        } else {
            $this->editMode = false;
        }

    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'short_text' => 'nullable|string|max:500',

            'full_text' => 'nullable|string',
            'event_id' => 'nullable|integer',
            'athlete_id' => 'nullable|integer',

            'sport_type_ids' => 'nullable|array',
            'sport_type_ids.*' => 'integer|exists:sport_types,id',

            'photo' => 'nullable|image',
        ];
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showForm = true; // показать форму
    }

    public function cancel()
    {
        $this->showForm = false; // скрыть форму
    }


    public function edit(News $news)
    {
        $this->currentNews = $news;
        $this->title = $news->title;
        $this->date = $news->date->format('Y-m-d');
        $this->short_text = $news->short_text;
        $this->full_text = $news->full_text;
        $this->event_id = $news->event_id;
        $this->athlete_id = $news->athlete_id;

//        $this->sport_type_ids = $news->sportTypes()->pluck('id')->toArray();
        $this->sport_type_ids = $news->sportTypes()->pluck('sport_types.id')->toArray();

        $this->editMode = true;
        $this->dispatch('show-edit-modal');
    }

    public function saveData()
    {
        $this->validate();

        // Временная проверка данных
        logger()->info('Saving data:', [
            'full_text' => $this->full_text,
            'other_fields' => $this->only(['title', 'date'])
        ]);

        $user = Auth()->user();

        $data = [
            'title' => $this->title,
            'date' => $this->date,
            'short_text' => $this->short_text,
            'full_text' => $this->full_text,
            'event_id' => $this->event_id,
            'athlete_id' => $this->athlete_id,
            'user_autor_id' => $user->id,
        ];

        if ($this->photo) {
            $path = $this->photo->store('timefv_news_photos', 'public');
            $data['photo'] = $path;
        }

        if ($this->editMode) {
            $this->currentNews->update($data);
            $this->currentNews->sportTypes()->sync($this->sport_type_ids);
            session()->flash('success', 'Новость обновлена');
        } else {
            $news = News::create($data);
            $news->sportTypes()->sync($this->sport_type_ids);
            session()->flash('success', 'Новость создана');
        }

        $this->resetForm();
//        $this->dispatch('hide-edit-modal');
//        return redirect(route('admin.news'));
        return redirect(route('admin.news'));
    }

    public function delete(News $news)
    {
        $news->delete();
        session()->flash('success', 'Новость удалена');
    }

    private function resetForm()
    {
        $this->reset([
            'title', 'date', 'short_text', 'photo', 'full_text',
            'event_id', 'athlete_id', 'sport_type_ids', 'currentNews', 'editMode'
        ]);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.news.admin-form');
    }
}
