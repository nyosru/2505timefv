<div>
    <h2 class="text-2xl font-bold mb-4">Список спортсменов</h2>

    <ul>
        @forelse($athletes as $athlete)
            <li class="mb-4 border-b pb-2 flex items-center space-x-4">
                @if($athlete->photo)
                    <img src="{{ asset('storage/' . $athlete->photo) }}" alt="Фото {{ $athlete->last_name }}" class="w-16 h-16 object-cover rounded-full">
                @else
                    <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center text-gray-600">
                        Нет фото
                    </div>
                @endif
                <div>
                    <a href="{{ route('athletes.show', $athlete->id) }}" class="text-blue-600 hover:underline font-semibold">
                        {{ $athlete->last_name }} {{ $athlete->first_name }} {{ $athlete->middle_name }}
                    </a>
                    @if($athlete->birth_date)
                        <div class="text-gray-500 text-sm">Дата рождения: {{ $athlete->birth_date->format('d.m.Y') }}</div>
                    @endif
                </div>
            </li>
        @empty
            <li>Спортсмены не найдены.</li>
        @endforelse
    </ul>

    <div class="mt-4">
        {{ $athletes->links() }}
    </div>
</div>
