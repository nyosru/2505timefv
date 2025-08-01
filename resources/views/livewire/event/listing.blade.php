<div>

    <livewire:cms2.app.breadcrumb
            {{--            :board_id="$leed->column->board_id"--}}
            {{--            :board_id=""--}}
            :menu="[
                    ['route'=>'events.index','name'=>'Мероприятия', 'route-var' => [] ]
{{--                    ,--}}
{{--                    ['route'=>'events.show','name'=>( strlen($event->title) > 50 ? substr($event->title, 0, 50) . '...' : ( $event->title  ?? '-') ), 'route-var' => [ 'id' => $event->id ] ]--}}
{{--                    [--}}
{{--                        'route'=>'leed',--}}
{{--                        'name'=>( $leed->column->board->name ?? 'x' )--}}
{{--                    ],--}}
{{--                     [ 'link' => 'no', 'name'=> ( ($leed->name ?? '-') ) ]--}}
                 ]"
    />


    <h2 class="
    text-center md:text-left
    text-2xl font-bold mb-4">События Мероприятия</h2>

@if($sport_types->count())
        <div class="mb-6">
            {{--        <label for="sportTypeFilter" class="block mb-1 font-medium">Фильтр по виду спорта</label>--}}
            <select id="sportTypeFilter" wire:model.live="selectedSportType" class="border p-2 rounded w-full max-w-xs">
                <option value="">Все виды спорта</option>
                @foreach($sport_types as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>

{{--            $allOrganizations--}}
{{--            <pre class="text-xs max-h-[400px] overflow-auto">{{ print_r($allOrganizations->toArray()) }}</pre>--}}

            <select id="organizationsFilter" wire:model.live="selectedOrganizations" class="border p-2 rounded w-full max-w-xs">
                <option value="">Организации</option>
                @foreach($allOrganizations as $org )
                    <option value="{{ $org->id }}">{{ $org->name }} ({{ $org->city->country->name ?? '.' }} {{ $org->city->name ?? '.' }} {{ $org->address ?? '.' }})</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="mb-4 flex gap-4">
        <a
{{--                wire:click="$set('dateFilter', null)"--}}
                href="{{ route('events.index',['dateFilter' => '', 'selectedSportType' => $selectedSportType ?? '', 'selectedOrganizations' => $selectedOrganizations ?? ''  ]) }}"
wire:navigate
                class="px-4 py-2 rounded {{ empty($dateFilter) ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
            Все
        </a>
        <a
{{--                wire:click="$set('dateFilter', 'past')"--}}
                href="{{ route('events.index',['dateFilter' => 'past', 'selectedSportType' => $selectedSportType ?? '', 'selectedOrganizations' => $selectedOrganizations ?? ''  ]) }}"
wire:navigate
                class="px-4 py-2 rounded {{ $dateFilter === 'past' ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
            Прошедшие
        </a>
        <a
{{--                wire:click="$set('dateFilter', 'current')"--}}
                href="{{ route('events.index',['dateFilter' => 'current', 'selectedSportType' => $selectedSportType ?? '', 'selectedOrganizations' => $selectedOrganizations ?? ''  ]) }}"
wire:navigate
                class="px-4 py-2 rounded {{ $dateFilter === 'current' ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
            Сейчас проходят
        </a>
        <a
{{--                wire:click="$set('dateFilter', 'upcoming')"--}}
                href="{{ route('events.index',['dateFilter' => 'upcoming', 'selectedSportType' => $selectedSportType ?? '', 'selectedOrganizations' => $selectedOrganizations ?? ''  ]) }}"
wire:navigate
                class="px-4 py-2 rounded {{ $dateFilter === 'upcoming' ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
            Скоро
        </a>
    </div>

    <div class="my-4">
        {{ $events->links('vendor.pagination.my1tailwind') }}
    </div>

    <div id="card-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[20px] w-full">
        @forelse($events as $event)
            {{--            <div><pre>{{ print_r($event->toArray()) }}</pre></div>--}}
            <livewire:event.listing-item :event="$event" :key="'item-event-'.$event->id" />
            @endforeach
    </div>

    @if(1==2)
        <ul>
            @forelse($events as $event)
                <li class="mb-4 border-b pb-2">
                    <a href="{{ route('events.show', $event->id) }}"
                       class="text-blue-600 hover:underline font-semibold">
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
    @endif

    <div class="mt-4">
        {{ $events->links('vendor.pagination.my1tailwind') }}
    </div>
</div>
