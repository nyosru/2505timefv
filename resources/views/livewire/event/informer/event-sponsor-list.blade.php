<section class="w-full md:w-1/2 lg:w-1/3 mt-8">
    <h2 class="text-xl font-semibold mb-3">Спонсоры</h2>
    <div class="max-h-96 overflow-y-scroll">
        <ul class="space-y-3">
            @foreach($list as $k => $v )
                <li class="flex flex-col items-left
{{--                 bodrder-l-2 border-l-gray-200 p-3--}}
{{--                gap-3--}}
{{--            @if($v->pivot->place == 1 ) text-xl font-bold @endif--}}
{{--            @if($v->pivot->place == 2 ) text-lg font-bold @endif--}}
{{--            @if($v->pivot->place == 3 ) text-lg @endif--}}
            ">
                    {{--                <pre class="text-xs">{{ print_r($v->toArray(),1) }}</pre>--}}
                    {{--                <div class="w-6 font-semibold text-gray-600">{{ $index + 1 }}.</div>--}}
                    {{--                <div class="w-10 h-10 rounded-full bg-gray-300"></div>--}}
                    {{--                    @if( !empty($v->pivot->place) )--}}
                    {{--                        <div class="w-12 font-semibold text-gray-600">--}}
                    {{--                            <img src="/img/m{{ $v->pivot->place }}.png" alt="" width="100%">--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}
                    {{--                <div class="w-12 h-10 rounded-full bg-gray-300"></div>--}}
                    @if( !empty($v->company_name) )
                        <div class="text-lg font-bold">
                            @if( !empty($v->link) )
                                <a href="{{ $v->link }}" class="underline text-blue-700" target="_blank">
                                    {{ $v->company_name }}
                                </a>
                            @else
                                {{ $v->company_name }}
                            @endif
                        </div>
                    @endif
                    @if(
                        !empty($v->last_name) ||
                        !empty( $v->first_name )
                    )
                        <div class="ml-5">
                            {{ $v->last_name ?? '' }}
                            {{ $v->first_name ?? ''  }}
                        </div>
                    @endif
                    @if( !empty($v->comment) )
                        <div class="ml-5 text-xs">
                            {{ $v->comment }}
                        </div>
                    @endif

                </li>
            @endforeach
        </ul>
    </div>
</section>
