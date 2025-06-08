<div class="w-full p-6 mt-10">
    <h3 class="text-2xl font-bold mb-6">
        {{ $id ? 'Редактирование мероприятия' : 'Добавление нового мероприятия' }}
    </h3>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex flex-row">
        <div class="w-1/2">
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
                    <label for="country_id" class="block font-semibold mb-1">Страна *</label>
                    <select id="country_id" wire:model.live="country_id"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                            required>
                        <option value="">Выберите страну</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Город -->
                <div class="mb-4">
                    <label for="city_id" class="block font-semibold mb-1">Город *</label>
                    <select id="city_id" wire:model.live="city_id"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                            required>
                        <option value="">Выберите город</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Место проведения -->
                <div class="mb-4">
                    <label for="sport_place_id" class="block font-semibold mb-1">Место проведения *</label>
                    <select id="sport_place_id" wire:model.live="sport_place_id"
                            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                            required>
                        <option value="">Выберите место</option>
                        @foreach($venues as $venue)
                            <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                        @endforeach
                    </select>
                    @error('sport_place_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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
                            <img src="{{ $photoPreview }}" alt="Фото мероприятия"
                                 class="max-w-full h-auto rounded shadow"/>
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
        <div class="w-1/2">
            @if(!empty($id))
                <div class="bg-orange-100">
                    <livewire:event.event-attachment-manager-component :eventId="$id" :type="'image'"/>
                </div>
                <div class="bg-cyan-100">
                    <livewire:event.event-attachment-manager-component :eventId="$id" :type="'video'"/>
                </div>

            @endif
        </div>
    </div>
    <div class="flex flex-wrap flex-row">

        <div class="bg-red-100 w-full md:w-1/2 xl:w-1/3">
            <livewire:event.event-attachment-manager-component :eventId="$id" type="document" :key="'atachment-'.rand()" />
        </div>
        <div class="bg-orange-100 w-full md:w-1/2 xl:w-1/3">
            publication
            <livewire:event.event-attachment-manager-component :eventId="$id" type="publication" :key="'publication-'.rand()" />
        </div>

        <div class="bg-blue-100 w-full md:w-1/2 xl:w-1/3">
            <livewire:event-adm.event-group-nagrada-manager-component
                    :hideSetEvent="true" :eventId="$id" key="nagrada"/>
        </div>
        <div class="bg-green-100 w-full md:w-1/2 xl:w-1/3">
            <livewire:event.event-participiant-manager-component :eventId="$id" key="parcipants"/>
        </div>
        <div class="bg-orange-100w-full md:w-1/2 xl:w-1/3">
            <livewire:event.event-guest-manager-component :eventId="$id" key="guest" />
        </div>
        <div class="bg-green-100 w-full md:w-1/2 xl:w-1/3">
            <livewire:event.event-sponsor-manager-component :eventId="$id" key="sponsor" />
        </div>

    </div>
</div>
