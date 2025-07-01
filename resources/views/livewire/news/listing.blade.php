<div>

{{--    <pre class="text-xs">{{ print_r($user->toArray(),1) }}</pre>--}}


    <livewire:cms2.app.breadcrumb
            {{--            :board_id="$leed->column->board_id"--}}
            {{--            :board_id=""--}}
            :menu="[
                    ['route'=>'news','name'=>'Новости', 'route-var' => [] ]
{{--                    ,--}}
{{--                    ['route'=>'events.show','name'=>( strlen($event->title) > 50 ? substr($event->title, 0, 50) . '...' : ( $event->title  ?? '-') ), 'route-var' => [ 'id' => $event->id ] ]--}}
{{--                    [--}}
{{--                        'route'=>'leed',--}}
{{--                        'name'=>( $leed->column->board->name ?? 'x' )--}}
{{--                    ],--}}
{{--                     [ 'link' => 'no', 'name'=> ( ($leed->name ?? '-') ) ]--}}
                 ]"
    />


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

            <select wire:model="sortDirection"
                    wire:change="resetPage"  class="border p-2 rounded">
                <option value="desc">сначала новые</option>
                <option value="asc">сначала старые</option>
            </select>

        </div>
    </div>

    <!-- Список новостей -->
    <div id="cards-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-[20px] w-full">
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
