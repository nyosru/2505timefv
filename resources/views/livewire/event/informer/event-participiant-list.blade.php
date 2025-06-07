<section class="w-full md:w-1/2 lg:w-1/3 mt-8 px-2">
    <h2 class="text-xl font-semibold mb-3">Спортсмены</h2>
    <div
            {{--            class="max-h-96 overflow-y-scroll"--}}
    >

        {{--        <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($list->toArray(),1) }}</pre>--}}
        {{--777888--}}
        <div class="flex flex-col space-y-2">
        @foreach($list as $group )

            @if( $group->athletes->count() == 0 )
                @continue
            @endif

            <div class="bg-blue-200 p-1">
                {{$group->name}}
                {{--                <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($group->toArray(),1) }}</pre>--}}
            </div>

            @foreach($group->athletes as $atlete )

                    <livewire:event.informer.event-participiant-item :atlete="$atlete" :place="$atlete->pivot->place ?? null" />

{{--                    <li>--}}
{{--                    $atlete--}}
{{--                    <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($atlete->toArray(),1) }}</pre>--}}
{{--                </li>--}}
            @endforeach

            @if(1==2)
                <li>
                    {{--                <pre>{{ print_r($v->eventParticipants[0]->eventGroupNagrada->name, 1) }}</pre>--}}
                    <div class="bg-orange-200 p-1">{{ print_r($v->eventParticipants[0]->eventGroupNagrada->name, 1) }}</div>
                </li>
            @endif

            @if(1==2)
                <li class="flex items-center gap-3
            @if($v->pivot->place == 1 ) text-xl font-bold @endif
            @if($v->pivot->place == 2 ) text-lg font-bold @endif
            @if($v->pivot->place == 3 ) text-lg @endif
            ">
                    {{--                <pre class="text-xs">{{ print_r($v->toArray(),1) }}</pre>--}}
                    {{--                <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>--}}
                    {{--                <div class="w-10 h-10 rounded-full bg-gray-300"></div>--}}
                    @if( !empty($v->pivot->place) )
                        <div class="w-12 font-semibold text-gray-600">
                            <img src="/img/m{{ $v->pivot->place }}.png" alt="" width="100%">
                        </div>
                    @endif
                    {{--                <div class="w-12 h-10 rounded-full bg-gray-300"></div>--}}
                    <span>
                    {{ $v->last_name }}
                        {{ $v->first_name }}
                </span>
                </li>
                @endif
                @endforeach
                </ul>
    </div>
</section>
