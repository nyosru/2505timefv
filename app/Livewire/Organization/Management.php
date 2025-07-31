<?php

namespace App\Livewire\Organization;

use App\Models\Organizer;
use App\Models\City;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Management extends Component
{
    use WithPagination, WithFileUploads;

    public $search = ''; // ...
    public $perPage = 10;
    public $showModal = false;
    public $organizerId = null;

    public $name;
    public $city_id;
    public $address;
    public $logo;
    public $logoPreview;
    public $website;

    protected $rules = [
        'name' => 'required|string|max:255',
        'city_id' => 'nullable|exists:cities,id',
        'address' => 'nullable|string|max:255',
        'logo' => 'nullable|image|max:5120',
        'website' => 'nullable|url|max:255',
    ];

    protected $messages = [
        'name.required' => 'Название обязательно',
        'city_id.exists' => 'Выбран неверный город',
        'logo.image' => 'Логотип должен быть изображением',
        'website.url' => 'Адрес сайта должен быть корректным URL',
    ];

    public function render()
    {
        $organizers = Organizer::with('city')
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->orderBy('name')
            ->paginate($this->perPage);

        $cities = City::with(['country'])->orderBy('name')->get();

        return view('livewire.organization.management', compact('organizers', 'cities'));
    }


    // Открыть форму добавления новой организации
    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    // Открыть форму редактирования организации
    public function edit($id)
    {
        $this->resetValidation();
        $this->organizerId = $id;
        $org = Organizer::findOrFail($id);

        $this->name = $org->name;
        $this->city_id = $org->city_id;
        $this->address = $org->address;
        $this->website = $org->website;
        $this->logoPreview = $org->logo ? asset('storage/' . $org->logo) : null;
        $this->logo = null;

        $this->showModal = true;
    }

    // Сброс полей формы и ошибок
    protected function resetForm()
    {
        $this->reset(['name', 'city_id', 'address', 'logo', 'logoPreview', 'website', 'organizerId']);
        $this->resetValidation();
    }

    public function updatedLogo()
    {
        $this->validateOnly('logo');

        // Предпросмотр загруженного лого
        $this->logoPreview = $this->logo ? $this->logo->temporaryUrl() : null;
    }

    public function save()
    {
        $this->validate();

        if ($this->organizerId) {
            $organizer = Organizer::findOrFail($this->organizerId);
        } else {
            $organizer = new Organizer();
        }

        $organizer->name = $this->name;
        $organizer->city_id = $this->city_id;
        $organizer->address = $this->address;
        $organizer->website = $this->website;

        // Обработка лого
        if ($this->logo) {
            // Можно удалить старый файл, если нужно

            $path = $this->logo->store('organizers/logos', 'public');
            $organizer->logo = $path;
        }

        $organizer->save();

        session()->flash('success', $this->organizerId ? 'Организация обновлена' : 'Организация добавлена');

        $this->showModal = false;
        $this->resetForm();

        // Обновляем страницу / пагинацию
        $this->resetPage();
    }

    public function delete($id)
    {
        $org = Organizer::findOrFail($id);

        // Можно удалить файл лого из хранилища, если нужно
        if ($org->logo) {
            \Storage::disk('public')->delete($org->logo);
        }

        $org->delete();

        session()->flash('success', 'Организация удалена');

        $this->resetPage();
    }

    // Закрыть форму
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

}
