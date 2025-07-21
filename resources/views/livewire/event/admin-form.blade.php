<div class="w-full p-6 mt-10">
    <h3 class="text-2xl font-bold mb-6">
        {{ $id ? 'Редактирование мероприятия' : 'Добавление нового мероприятия' }}
    </h3>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif


    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <strong>Обнаружены ошибки:</strong>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->messages() as $field => $messages)
                    @foreach ($messages as $message)
                        <li><a href="#{{ $field }}" class="underline hover:text-red-900">{{ $message }}</a></li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data" novalidate>

        <div class="flex flex-row">
            <div class="w-1/2">
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
                <div class="mb-4 flex flex-row">

                    <div class="w-1/2">
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

                    <div class="w-1/2">
                        <label for="events_date_finished" class="block font-semibold mb-1">до Даты</label>
                        <input
                                id="events_date_finished"
                                type="date"
                                wire:model.defer="events_date_finished"
                                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                                required
                        >
                        @error('events_date_finished') <span
                                class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                </div>


                <!-- Страна -->
                <div class="mb-4">

                    <div class="mb-4">
                        <label for="sport_place_id" class="block font-semibold mb-1">Место проведения *</label>
                        <select id="sport_place_id" wire:model="sport_place_id"
                                class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:ring-blue-300"
                                required>
                            <option value="">Выберите место</option>
                            @foreach($sport_places as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->city->country->name }}
                                    / {{ $s->city->name }}
                                    / {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('sport_place_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

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
                                 class="max-w-[200px] h-auto rounded shadow"/>
                        </div>
                    @endif
                </div>


                <!-- Кнопки -->


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

                <!-- Виды спорта -->
                <div class="my-4 w-full">
                    <label class="block font-semibold mb-1">Виды спорта *</label>
                    <div class="flex flex-wrap
{{--                        gap-4 --}}
{{--                        gap-1--}}
                        max-h-[138px] overflow-auto
                        border border-blue-300 border-1
                        rounded p-2
                        ">
                        @foreach(\App\Models\SportType::orderBy('name')->get() as $sportType)
                            <label class="inline-flex items-center space-x-2 bg-blue-100 p-1 mr-1 mb-1">
                                <input type="checkbox" wire:model="sport_type_ids" value="{{ $sportType->id }}"
                                       class="form-checkbox"/>
                                <span>{{ $sportType->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('sport_type_ids') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>


            </div>
        </div>


        <!-- Кнопки -->
        <div class="max-w-[350px]">
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
        </div>
    </form>


    @if(1==2)
        <div class="flex flex-wrap flex-row mt-8">

            <div class="bg-red-100 w-full md:w-1/2 xl:w-1/3">
                <livewire:event.event-attachment-manager-component :eventId="$id" type="document"
                                                                   :key="'atachment-'.rand()"/>
            </div>
            <div class="bg-orange-100 w-full md:w-1/2 xl:w-1/3">
                publication
                <livewire:event.event-attachment-manager-component :eventId="$id" type="publication"
                                                                   :key="'publication-'.rand()"/>
            </div>

            <div class="bg-blue-100 w-full md:w-1/2 xl:w-1/3">

                {{--            <pre>{{ print_r($event->groupsNagrada->toArray() ) }}</pre>--}}
                {{--            <pre>{{ print_r($event,1 ) }}</pre>--}}

                <livewire:event-adm.event-group-nagrada-manager-component
                        :hideSetEvent="true" :eventId="$id" key="nagrada"/>
            </div>

            <div class="bg-green-100 w-full md:w-1/2 xl:w-1/3">
                <livewire:event.event-participiant-manager-component :eventId="$id" key="parcipants"/>
            </div>

            <div class="bg-orange-100w-full md:w-1/2 xl:w-1/3">
                <livewire:event.event-guest-manager-component :eventId="$id" key="guest"/>
            </div>
            <div class="bg-green-100 w-full md:w-1/2 xl:w-1/3">
                <livewire:event.event-sponsor-manager-component :eventId="$id" key="sponsor"/>
            </div>

        </div>
    @endif
</div>
