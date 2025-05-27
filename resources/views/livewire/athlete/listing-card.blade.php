<div class="mb-4 border-b pb-2 flex space-x-4 items-start text-left">
    @if($athlete->photo)
        <img src="{{ asset('storage/' . $athlete->photo) }}" alt="Фото {{ $athlete->last_name }}"
             class="w-32 h-48 object-cover rounded-lg">
    @else
        <div class="w-32 h-48 bg-gray-300 rounded-lg flex items-center justify-center text-gray-600">
            Нет фото
        </div>
    @endif
    <div class="items-start text-left">
        <a href="{{ route('athletes.show', $athlete->id) }}" class="text-blue-600 hover:underline font-semibold">
            {{ $athlete->last_name }} {{ $athlete->first_name }} {{ $athlete->middle_name }}
        </a>
        @if($athlete->birth_date)
            <div class="text-gray-500 text-sm">Дата рождения: {{ $athlete->birth_date->format('d.m.Y') }}</div>
        @endif
    </div>
</div>