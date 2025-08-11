<?php

namespace App\Livewire\news;

use Livewire\Component;
use App\Models\news;
use App\Models\Organizer;
use Illuminate\Validation\Rule;
class CompanyParticipantesManager extends Component
{

    public int $newsId;
    public News $news;

    public $availableOrganizers = [];
    public $selectedOrganizerId = null;


    public function mount( News $newsId )
    {
        $this->news = $newsId;
        $this->newsId = $newsId->id;
//        $this->loadnews();
        $this->loadAvailableOrganizers();
    }

//    public function loadnews()
//    {
//        $this->news = news::with('companyParticipantes')->findOrFail($this->newsId);
//    }

    /**
     * Загружаем организаторов, которых пока нет в связанном списке, чтобы нельзя было добавить дубли.
     */
    public function loadAvailableOrganizers()
    {
        $usedIds = $this->news->companyParticipantes->pluck('id')->toArray();
        $this->availableOrganizers = Organizer::whereNotIn('id', $usedIds)
            ->orderBy('name')
            ->get();
    }

    /**
     * Добавить выбранного организатора
     */
    public function addOrganizer()
    {
        $this->validate([
            'selectedOrganizerId' => [
                'required',
                'integer',
                Rule::exists('organizers', 'id')
            ],
        ]);
        $this->news->companyOrganizators()->attach($this->selectedOrganizerId);

//        $this->loadnews();
//        $this->loadAvailableOrganizers();

        // Очистить выбор
        $this->selectedOrganizerId = null;

//        $this->dispatchBrowsernews('notify', ['message' => 'Организатор успешно добавлен']);
    }

    /**
     * Удалить организатора по id
     */
    public function removeOrganizer($organizerId)
    {
        $this->news->companyParticipantes()->detach($organizerId);

        $this->loadnews();
        $this->loadAvailableOrganizers();

//        $this->dispatch('notify', ['message' => 'Организатор удалён']);
    }


    public function render()
    {
        return view('livewire.news.company-participantes-manager');
    }
}
