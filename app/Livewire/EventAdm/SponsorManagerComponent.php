<?php

namespace App\Livewire\EventAdm;

use Livewire\Component;
use App\Models\Sponsor;

class SponsorManagerComponent extends Component
{
    public $company_name;
    public $last_name;
    public $first_name;
    public $middle_name;
    public $comment;
    public $link;
    public $photo;
    public $birth_date;

    public $sponsorId = null;

    protected $rules = [
        'company_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'first_name' => 'nullable|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'comment' => 'nullable|string|max:1000',
        'link' => 'nullable|url|max:255',
        'photo' => 'nullable|string|max:255', // предполагается путь или URL
        'birth_date' => 'nullable|date',
    ];

    public function render()
    {
        $sponsors = Sponsor::orderBy('company_name')->paginate(10);

        return view('livewire.event-adm.sponsor-manager-component', [
            'sponsors' => $sponsors,
        ]);
    }

    public function resetForm()
    {
        $this->reset([
            'company_name', 'last_name', 'first_name', 'middle_name',
            'comment', 'link', 'photo', 'birth_date', 'sponsorId'
        ]);
        $this->resetValidation();
    }

    public function edit(Sponsor $sponsor)
    {
        $this->sponsorId = $sponsor->id;
        $this->company_name = $sponsor->company_name;
        $this->last_name = $sponsor->last_name;
        $this->first_name = $sponsor->first_name;
        $this->middle_name = $sponsor->middle_name;
        $this->comment = $sponsor->comment;
        $this->link = $sponsor->link;
        $this->photo = $sponsor->photo;
        $this->birth_date = $sponsor->birth_date ? $sponsor->birth_date->format('Y-m-d') : null;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'company_name' => $this->company_name,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'comment' => $this->comment,
            'link' => $this->link,
            'photo' => $this->photo,
            'birth_date' => $this->birth_date,
        ];

        if ($this->sponsorId) {
            Sponsor::find($this->sponsorId)->update($data);
            session()->flash('success', 'Спонсор обновлён');
        } else {
            Sponsor::create($data);
            session()->flash('success', 'Спонсор добавлен');
        }

        $this->resetForm();
    }

    public function delete(Sponsor $sponsor)
    {
        $sponsor->delete();
        session()->flash('success', 'Спонсор удалён');
    }
}
