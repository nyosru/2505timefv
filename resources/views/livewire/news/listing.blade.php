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


    <!-- Фильтры -->
    <div class="">

        <div class="mb-6 flex flex-wrap gap-4 items-center">


            <select wire:model="sortDirection"
                    wire:change="resetPage" class="
                    border-none
{{--                    border p-2 rounded--}}
                    ">
                <option value="desc">&#9650; сначала новые</option>
                <option value="asc">&#9660; сначала старые</option>
            </select>

            @if($events->count())
                <select
                        {{--                    wire:model.live="selectedEvent" --}}
                        wire:model.live="selectedEvent"
{{--                        wire:change="resetPage"--}}
                        class="border p-2 rounded">
                    <option value="">События</option>
                    @foreach($events as $id => $name)
                        <option value="{{ $id }}">Событие {{ $name }}</option>
                    @endforeach
                </select>
            @endif
            @if($athletes->count())
                <select
                        {{--                    wire:model.live="selectedAthlete" --}}
                        wire:model.live="selectedAthlete"
{{--                        wire:change="resetPage"--}}
                        class="border p-2 rounded">
                    <option value="">Спортсмены</option>
                    @foreach($athletes as $id => $name)
                        <option value="{{ $id }}">атлет {{ $name }}</option>
                    @endforeach
                </select>
            @endif
            @if($sport_types->count())
                <select wire:model.live="selectedSportType"
{{--                        wire:change="resetPage"--}}
                        class="border p-2 rounded">
                    <option value="">Все виды спорта</option>
                    @foreach($sport_types as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            @endif

        </div>
    </div>


    <!-- Пагинация сверху -->
    <div class="mt-4">
        {{ $news->links('vendor.pagination.my1tailwind'
//, [
//        'sortDirection' => $sortDirection,
//        'selectedEvent' => $selectedEvent,
//        'selectedAthlete' => $selectedAthlete,
//]
)
}}
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
