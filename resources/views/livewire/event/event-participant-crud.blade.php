<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Управление участниками мероприятий</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded"
             x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 3000)"
        >
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6">
        @if ($updateMode)
            <h3 class="text-xl mb-2">Редактировать участника</h3>
        @else
            <h3 class="text-xl mb-2">Добавить нового участника</h3>
        @endif

        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
            <div class="mb-3">
                <label class="block font-semibold mb-1">Спортсмен *</label>
                <select wire:model.defer="athlete_id" class="border p-2 rounded w-full">
                    <option value="">Выберите спортсмена</option>
                    @foreach($athletes as $athlete)
                        <option value="{{ $athlete->id }}">
                            {{ $athlete->last_name }} {{ $athlete->first_name }}
                        </option>
                    @endforeach
                </select>
                @error('athlete_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Мероприятие *</label>
                <select wire:model.defer="event_id" class="border p-2 rounded w-full">
                    <option value="">Выберите мероприятие</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->event_date->format('d.m.Y') ?? '' }} / {{ $event->title ?? 'Без названия' }} </option>
                    @endforeach
                </select>
                @error('event_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Занятое место *</label>
                <input type="number" wire:model.defer="place" min="0" class="border p-2 rounded w-full" />
                @error('place') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                @if ($updateMode)
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Обновить</button>
                    <button type="button" wire:click="cancel" class="ml-2 px-4 py-2 border rounded hover:bg-gray-100">Отмена</button>
                @else
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Создать</button>
                @endif
            </div>
        </form>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr>
            <th class="border border-gray-300 p-2 text-left">ID</th>
            <th class="border border-gray-300 p-2 text-left">Спортсмен</th>
            <th class="border border-gray-300 p-2 text-left">Мероприятие</th>
            <th class="border border-gray-300 p-2 text-left">Место</th>
            <th class="border border-gray-300 p-2 text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($participants as $participant)
            <tr>
                <td class="border border-gray-300 p-2">{{ $participant->id }}</td>
                <td class="border border-gray-300 p-2">
                    {{ $participant->athlete->last_name ?? '-' }} {{ $participant->athlete->first_name ?? '' }}
                </td>
                <td class="border border-gray-300 p-2">{{ $participant->event->title ?? '-' }}</td>
                <td class="border border-gray-300 p-2">{{ $participant->place }}</td>
                <td class="border border-gray-300 p-2 text-center space-x-2">
                    <button wire:click="edit({{ $participant->id }})" class="text-blue-600 hover:underline">Редактировать</button>
                    <button wire:click="delete({{ $participant->id }})"
                            onclick="confirm('Удалить участника?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">Удалить</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-2 text-center text-gray-500">Участники не найдены.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $participants->links('vendor.pagination.my1tailwind') }}
    </div>
</div>
