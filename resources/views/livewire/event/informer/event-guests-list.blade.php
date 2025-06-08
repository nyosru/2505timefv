<section class="w-full md:w-1/2 lg:w-1/3 mt-8">
    <h2 class="text-xl font-semibold mb-3">Почётные гости</h2>
    <div
{{--            class="max-h-96 overflow-y-scroll"--}}
    >
        <ul class="space-y-2">
            @foreach($list as $k => $v )
                <li class="flex flex-col items-left
{{--                gap-3 --}}
{{--            @if($v->pivot->place == 1 ) text-xl font-bold @endif--}}
{{--            @if($v->pivot->place == 2 ) text-lg font-bold @endif--}}
{{--            @if($v->pivot->place == 3 ) text-lg @endif--}}
            ">
                    {{--                                    <pre class="text-xs">{{ print_r($v->toArray(),1) }}</pre>--}}
                    {{--                <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>--}}
                    {{--                <div class="w-10 h-10 rounded-full bg-gray-300"></div>--}}
                    {{--                    @if( !empty($v->pivot->place) )--}}
                    {{--                        <div class="w-12 font-semibold text-gray-600">--}}
                    {{--                            <img src="/img/m{{ $v->pivot->place }}.png" alt="" width="100%">--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}
                    {{--                <div class="w-12 h-10 rounded-full bg-gray-300"></div>--}}
                    <h3 class="font-bold">
                        {{ $v->last_name }}
                        {{ $v->first_name }}
                    </h3>
                    <div class="ml-5 text-xs">
                        {{ $v->comment }}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
