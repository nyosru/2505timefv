<section class="w-full
{{--md:w-1/2 --}}
{{--lg:w-1/3 --}}
mt-8
{{--px-2--}}
">
    <h2 class="text-xl font-semibold mb-3
{{--    bg-blue-200--}}
    bg-white/80
     sticky top-[76px]  z-10 py-4">Победители и Участники (результаты по Категориям)</h2>
    <div
            {{--            class="max-h-96 overflow-y-scroll"--}}
    >

        {{--        <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($list->toArray(),1) }}</pre>--}}
        {{--777888--}}
        <div
                {{--                class="flex flex-col space-y-2"--}}
                class="grid grid-cols-1
                sm:grid-cols-2
                md:grid-cols-3
                xl:grid-cols-4 gap-4"
        >
            @foreach($list as $group )

                @if( $group->athletes->count() == 0 )
                    @continue
                @endif

                <div>

                    <div class="bg-blue-200 p-1">
                        {{$group->name}}
                        {{--                <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($group->toArray(),1) }}</pre>--}}
                    </div>

                    @foreach($group->athletes as $atlete )

                        <livewire:event.informer.event-participiant-item :atlete="$atlete"
                                                                         :place="$atlete->pivot->place ?? null"/>

                        {{--                    <li>--}}
                        {{--                    $atlete--}}
                        {{--                    <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($atlete->toArray(),1) }}</pre>--}}
                        {{--                    <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($atlete->toArray(),1) }}</pre>--}}
                        {{--                </li>--}}
                    @endforeach

                </div>
            @endforeach
        </div>
    </div>
</section>
