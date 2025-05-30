<div>

    <!-- Пагинация сверху -->
    <div class="mt-4">
        {{ $news->links('vendor.pagination.my1tailwind') }}
    </div>

    <!-- Фильтры -->
    <div class="">
    <div class="mb-6 flex gap-4 items-center">
        <select wire:model.live="selectedEvent" class="border p-2 rounded">
            <option value="">Все события</option>
            @foreach($events as $eventId)
                <option value="{{ $eventId }}">Событие #{{ $eventId }}</option>
            @endforeach
        </select>

        <select wire:model.live="selectedAthlete" class="border p-2 rounded">
            <option value="">Все спортсмены</option>
            @foreach($athletes as $athleteId)
                <option value="{{ $athleteId }}">Спортсмен #{{ $athleteId }}</option>
            @endforeach
        </select>

        <button
                wire:click="toggleSort"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Сортировка: {{ $sortDirection === 'desc' ? 'Новые сначала' : 'Старые сначала' }}
        </button>
    </div>
    </div>

    <!-- Список новостей -->
    <div id="cards-container" class="grid grid-cols-3 gap-[20px] w-full">
        @forelse($news as $item)
            <livewire:news.listing-card :item="$item" :key="$item->id"/>
        @empty
            <div class="col-span-3 text-center text-gray-500 py-4">Новостей по выбранным критериям не найдено</div>
        @endforelse
    </div>

    <!-- Пагинация снизу -->
    <div class="mt-4">
        {{ $news->links('vendor.pagination.my1tailwind') }}
    </div>
</div>
