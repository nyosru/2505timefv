<div>
    <h2 class="text-3xl font-bold mb-2">{{ $event->title }}</h2>
    <div class="text-gray-600 mb-4">
        <strong>Дата проведения:</strong> {{ $event->event_date->format('d.m.Y') }}<br>
        <strong>Место проведения:</strong> {{ $event->venue }}, {{ $event->city }}, {{ $event->country }}
    </div>

    @if($event->photo)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $event->photo) }}" alt="Фото мероприятия" class="max-w-full h-auto rounded">
        </div>
    @endif

    <div class="whitespace-pre-line">
        {{ $event->description }}
    </div>

    <div class="mt-6">
        <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">&larr; К списку мероприятий</a>
    </div>
</div>
