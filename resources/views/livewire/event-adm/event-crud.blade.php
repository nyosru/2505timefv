<div class="container mx-auto p-6">
    <button wire:click="create" class="mb-4 px-4 py-2 bg-blue-600 text-white rounded">
        Создать новое мероприятие
    </button>

    @if ($showForm)
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="text-2xl font-bold mb-4">
                {{ $editMode ? 'Редактирование' : 'Создание' }} мероприятия
            </h2>

            <form wire:submit.prevent="save">
                <!-- Поля формы -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label>Название *</label>
                        <input type="text" wire:model="title" class="w-full p-2 border rounded">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Дата начала *</label>
                        <input type="date" wire:model="event_date" class="w-full p-2 border rounded">
                        @error('event_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Дата окончания</label>
                        <input type="date" wire:model="events_date_finished" class="w-full p-2 border rounded">
                        @error('events_date_finished') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Тип спорта *</label>
                        <select wire:model="sport_type_id" class="w-full p-2 border rounded">
                            <option value="">Выберите тип</option>
                            @foreach($sportTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('sport_type_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Страна *</label>
                        <select wire:model="country_id" class="w-full p-2 border rounded">
                            <option value="">Выберите страну</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Город *</label>
                        <select wire:model="city_id" class="w-full p-2 border rounded">
                            <option value="">Выберите город</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Фото</label>
                        <input type="file" wire:model="photo" class="w-full p-2 border rounded">
                        @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4 col-span-2">
                        <label>Описание</label>
                        <textarea wire:model="description" class="w-full p-2 border rounded h-32"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="resetForm" class="px-4 py-2 border rounded">
                        Отмена
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Таблица мероприятий -->
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr class="bg-gray-50 border-b">
                <th class="px-6 py-3 text-left">Название</th>
                <th class="px-6 py-3 text-left">Дата начала</th>
                <th class="px-6 py-3 text-left">Тип спорта</th>
                <th class="px-6 py-3 text-left">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $event->title }}</td>
                    <td class="px-6 py-4">{{ $event->event_date->format('d.m.Y') }}</td>
                    <td class="px-6 py-4">{{ $event->sportType->name }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <button
                                wire:click="edit({{ $event->id }})"
                                class="text-blue-600 hover:underline"
                        >
                            Редактировать
                        </button>
                        <button
                                wire:click="delete({{ $event->id }})"
                                onclick="return confirm('Удалить мероприятие?')"
                                class="text-red-600 hover:underline"
                        >
                            Удалить
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>
