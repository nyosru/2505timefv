<div>

    <livewire:cms2.app.breadcrumb
            {{--            :board_id="$leed->column->board_id"--}}
            {{--            :board_id=""--}}
            :menu="[
                    ['route'=>'athletes.index','name'=>'Спортсмены', 'route-var' => [] ]
{{--                    ,--}}
{{--                    ['route'=>'events.show','name'=>( strlen($event->title) > 50 ? substr($event->title, 0, 50) . '...' : ( $event->title  ?? '-') ), 'route-var' => [ 'id' => $event->id ] ]--}}
{{--                    [--}}
{{--                        'route'=>'leed',--}}
{{--                        'name'=>( $leed->column->board->name ?? 'x' )--}}
{{--                    ],--}}
{{--                     [ 'link' => 'no', 'name'=> ( ($leed->name ?? '-') ) ]--}}
                 ]"
    />



    <h2 class="text-2xl font-bold mb-4">Спортсмены</h2>

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
