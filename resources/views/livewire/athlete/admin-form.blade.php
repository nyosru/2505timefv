{{--<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">--}}
{{--    <div class="bg-white rounded shadow-lg max-w-lg w-full p-6 relative">--}}
<div class="max-w-[450px]">
    <h3 class="text-xl font-bold mb-4">{{ $athleteId ? 'Редактировать спортсмена' : 'Добавить спортсмена' }}</h3>

    <form wire:submit.prevent="save" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
            <label class="block font-semibold mb-1">Фамилия *</label>
            <input type="text" wire:model.defer="last_name" class="w-full border rounded p-2"/>
            @error('last_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Имя *</label>
            <input type="text" wire:model.defer="first_name" class="w-full border rounded p-2"/>
            @error('first_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Отчество</label>
            <input type="text" wire:model.defer="middle_name" class="w-full border rounded p-2"/>
            @error('middle_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Дата рождения</label>
            <input type="date" wire:model.defer="birth_date" class="w-full border rounded p-2"/>
            @error('birth_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Фото</label>
            <input type="file" wire:model="photo" accept="image/*"/>
            @error('photo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            @if($photoPreview)
                <img src="{{ $photoPreview }}" alt="Фото спортсмена" class="mt-2 max-h-48 rounded"/>
            @endif
        </div>

        <div class="flex justify-end space-x-2 mt-6">
            <button type="button" wire:click="cancel" class="px-4 py-2 border rounded hover:bg-gray-100">Отмена</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Сохранить</button>
        </div>
    </form>
    {{--    </div>--}}
</div>
