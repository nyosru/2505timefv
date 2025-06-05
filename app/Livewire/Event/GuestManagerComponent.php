<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Guest;
use App\Models\EventGuest;
use App\Models\Event;

class GuestManagerComponent extends Component
{

    use WithPagination;

    public $search = '';
    public $guestId;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $comment;
    public $photo;
    public $birth_date;

    public $editMode = false;

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'comment' => 'nullable|string',
        'birth_date' => 'nullable|date',
        // 'photo' можно добавить позже с загрузкой
    ];

    public function render()
    {
        $guests = Guest::query()
            ->where(function ($query) {
                $query->where('first_name', 'like', '%'.$this->search.'%')
                    ->orWhere('last_name', 'like', '%'.$this->search.'%')
                    ->orWhere('middle_name', 'like', '%'.$this->search.'%');
            })
            ->orderBy('last_name')
            ->paginate(10);

        return view(
//            'livewire.guest-manager'
            'livewire.event.guest-manager-component'
            , [
            'guests' => $guests,
        ]);
    }

    public function resetForm()
    {
        $this->reset(['guestId', 'first_name', 'last_name', 'middle_name', 'comment', 'photo', 'birth_date', 'editMode']);
        $this->resetValidation();
    }

    public function edit(Guest $guest)
    {
        $this->guestId = $guest->id;
        $this->first_name = $guest->first_name;
        $this->last_name = $guest->last_name;
        $this->middle_name = $guest->middle_name;
        $this->comment = $guest->comment;
        $this->birth_date = $guest->birth_date ? $guest->birth_date->format('Y-m-d') : null;
        $this->editMode = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'comment' => $this->comment,
            'birth_date' => $this->birth_date,
        ];

        if ($this->guestId) {
            $guest = Guest::findOrFail($this->guestId);
            $guest->update($data);
            session()->flash('success', 'Гость обновлен');
        } else {
            Guest::create($data);
            session()->flash('success', 'Гость добавлен');
        }

        $this->resetForm();
    }

    public function delete(Guest $guest)
    {
        // Можно проверить связи с мероприятиями, если нужно
        $guest->delete();
        session()->flash('success', 'Гость удалён');
    }

}
