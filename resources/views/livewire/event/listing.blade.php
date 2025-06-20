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


    <h2 class="text-2xl font-bold mb-4">События Мероприятия</h2>

    <div class="my-4">
        {{ $events->links('vendor.pagination.my1tailwind') }}
    </div>

    <div id="card-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-[20px] w-full">
        @forelse($events as $event)
{{--            <div><pre>{{ print_r($event->toArray()) }}</pre></div>--}}
            <livewire:event.listing-item :event="$event"/>
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
