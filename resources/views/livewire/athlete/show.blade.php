<div>
    <h2 class="text-3xl font-bold mb-4">{{ $athlete->last_name }} {{ $athlete->first_name }} {{ $athlete->middle_name }}</h2>

    @if($athlete->photo)
        <img src="{{ asset('storage/' . $athlete->photo) }}" alt="Фото {{ $athlete->last_name }}" class="max-w-xs rounded shadow mb-4">
    @endif

    @if($athlete->birth_date)
        <div class="mb-2"><strong>Дата рождения:</strong> {{ $athlete->birth_date->format('d.m.Y') }}</div>
    @endif

    <div>
        <a href="{{ route('athletes.index') }}" class="text-blue-600 hover:underline">&larr; К списку спортсменов</a>
    </div>
</div>
