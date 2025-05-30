<div class="max-w-lg mx-auto p-6 bg-white rounded shadow mt-10">
    <h3 class="text-2xl font-bold mb-6">
        {{ $id ? 'Редактирование мероприятия' : 'Добавление нового мероприятия' }}
    </h3>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" novalidate>
        <!-- Название -->
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Название *</label>
            <input
                    id="title"
                    type="text"
                    wire:model.defer="title"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                    required
            >
            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Дата проведения -->
        <div class="mb-4">
            <label for="event_date" class="block font-semibold mb-1">Дата проведения *</label>
            <input
                    id="event_date"
                    type="date"
                    wire:model.defer="event_date"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                    required
            >
            @error('event_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Страна -->
        <div class="mb-4">
            <label for="country" class="block font-semibold mb-1">Страна *</label>
            <input
                    id="country"
                    type="text"
                    wire:model.defer="country"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                    required
            >
            @error('country') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Город -->
        <div class="mb-4">
            <label for="city" class="block font-semibold mb-1">Город *</label>
            <input
                    id="city"
                    type="text"
                    wire:model.defer="city"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                    required
            >
            @error('city') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Место проведения -->
        <div class="mb-4">
            <label for="venue" class="block font-semibold mb-1">Место проведения *</label>
            <input
                    id="venue"
                    type="text"
                    wire:model.defer="venue"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                    required
            >
            @error('venue') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Описание -->
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Описание</label>
            <textarea
                    id="description"
                    wire:model.defer="description"
                    rows="5"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
            ></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Фото -->
        <div class="mb-4">
            <label for="photo" class="block font-semibold mb-1">Фото</label>
            <input
                    id="photo"
                    type="file"
                    wire:model="photo"
                    accept="image/*"
                    class="block"
            >
            @error('photo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            @if($photoPreview)
                <div class="mt-3">
                    <span class="block font-semibold mb-1">Текущее фото:</span>
                    <img src="{{ $photoPreview }}" alt="Фото мероприятия" class="max-w-full h-auto rounded shadow" />
                </div>
            @endif
        </div>

        <!-- Кнопки -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('admin.events') }}"
               class="px-4 py-2 border rounded hover:bg-gray-100 text-gray-700">
                Отмена
            </a>
            <button
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Сохранить
            </button>
        </div>
    </form>
</div>
