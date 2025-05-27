<div>
    <h2 class="text-2xl font-bold mb-4">Список спортсменов</h2>

    <div id="card-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[20px] w-full">
        @forelse($athletes as $athlete)
            <livewire:athlete.listing-card :athlete="$athlete"/>
        @empty
            <div><p>Спортсмены не найдены.</p></div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $athletes->links('vendor.pagination.my1tailwind') }}
    </div>
</div>
