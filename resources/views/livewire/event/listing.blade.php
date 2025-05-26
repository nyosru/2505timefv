<div>
    <h2 class="text-2xl font-bold mb-4">Список мероприятий</h2>

    <ul>
        @forelse($events as $event)
            <li class="mb-4 border-b pb-2">
                <a href="{{ route('events.show', $event->id) }}" class="text-blue-600 hover:underline font-semibold">
                    {{ $event->title }}
                </a>
                <div class="text-gray-500 text-sm">
                    Дата: {{ $event->event_date->format('d.m.Y') }}<br>
                    Место: {{ $event->city }}, {{ $event->country }}<br>
                    {{ $event->venue }}
                </div>
            </li>
        @empty
            <li>Мероприятий пока нет.</li>
        @endforelse
    </ul>

    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>
