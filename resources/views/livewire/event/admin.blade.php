<div>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Управление мероприятиями</h2>
        <a href="{{ route('admin.events.form') }}"
{{--           wire:click="create" --}}
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Добавить мероприятие
        </a>
    </div>

    @if(session()->has('success'))
        <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border border-gray-300 rounded">
        <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border-b">Название</th>
            <th class="p-2 border-b">Дата</th>
            <th class="p-2 border-b">Город</th>
            <th class="p-2 border-b">Страна</th>
            <th class="p-2 border-b">Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($events as $event)
            <tr class="hover:bg-gray-50">
                <td class="p-2 border-b">{{ $event->title }}</td>
                <td class="p-2 border-b">{{ $event->event_date->format('d.m.Y') }}</td>
                <td class="p-2 border-b">{{ $event->city }}</td>
                <td class="p-2 border-b">{{ $event->country }}</td>
                <td class="p-2 border-b text-right space-x-2">
                    <a href="{{ route('admin.events.form', ['id' => $event->id]) }}" class="text-blue-600 hover:underline">Редактировать</a>
                    <button wire:click="delete({{ $event->id }})"
                            onclick="confirm('Удалить мероприятие?') || event.stopImmediatePropagation()"
                            class="text-red-600 hover:underline">
                        Удалить
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-2 text-center text-gray-500">Мероприятий нет</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $events->links() }}
    </div>

    @if($showForm)
        <livewire:event.admin-form :eventId="$selectedEventId" wire:key="event-form-{{ $selectedEventId ?? 'new' }}" />
    @endif
</div>
