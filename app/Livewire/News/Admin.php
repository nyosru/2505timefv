<?php

namespace App\Livewire\News;

use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{

    use WithPagination;

    public $title;
    public $date;
    public $short_text;
    public $full_text;
    public $event_id;
    public $athlete_id;

    public $currentNews = null;
    public $editMode = false;
    public $perPage = 15;
    public $search = '';

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'short_text' => 'nullable|string|max:500',
            'full_text' => 'required|string',
            'event_id' => 'nullable|integer',
            'athlete_id' => 'nullable|integer',
        ];
    }
    public $showForm = false;

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
        $this->editMode = true;
        $this->dispatch('show-edit-modal');
    }

    public function saveData()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'date' => $this->date,
            'short_text' => $this->short_text,
            'full_text' => $this->full_text,
            'event_id' => $this->event_id,
            'athlete_id' => $this->athlete_id,
        ];

        dd($data);

        if ($this->editMode) {
            $this->currentNews->update($data);
            session()->flash('success', 'Новость обновлена');
        } else {
            $ee = News::create($data);
            dd($ee);
            session()->flash('success', 'Новость создана');
        }

        $this->resetForm();
        $this->dispatch('hide-edit-modal');
    }

    public function delete(News $news)
    {
        $news->delete();
        session()->flash('success', 'Новость удалена');
    }

    private function resetForm()
    {
        $this->reset(['title', 'date', 'short_text', 'full_text', 'event_id', 'athlete_id', 'currentNews', 'editMode']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $qq = News::when($this->search, fn($q) => $q->where('title', 'like', '%'.$this->search.'%'));



        $user = auth()->user();
        $permissionName = 'р.НовостиАдмин (только свои) / в админке только свои записи';

// Проверяем, есть ли у пользователя это разрешение через роли
        if ($user->hasPermissionTo($permissionName)) {
            // Пользователь имеет разрешение через одну из своих ролей
//            dd(__LINE__);
            $qq->where('user_autor_id', $user->id);
        }
//        else {
//            dd(__LINE__);
////            abort(403, 'Доступ запрещён');
//        }


        $news = $qq->orderByDesc('date')
            ->paginate($this->perPage);

        return view('livewire.news.admin', compact('news'));
    }

//    public function render()
//    {
//        return view('livewire.news.admin');
//    }
}
