<div class="flex items-center gap-3
            @if($place == 1 ) text-xl font-bold @endif
            @if($place == 2 ) text-lg font-bold @endif
            @if($place == 3 ) text-lg @endif
            ">

    {{--    <pre  class="text-xs max-h-[200px] overflow-y-auto">{{ print_r($atlete,1) }}</pre>--}}
    {{--    <pre  class="text-xs max-h-[200px] overflow-y-auto">{{ print_r($place,1) }}</pre>--}}

    @if( !empty($place) )
        <div class="w-12 font-semibold text-gray-600">
            <img src="/img/m{{ $place }}.png" alt="" width="100%">
        </div>
    @endif
    {{--                <div class="w-12 h-10 rounded-full bg-gray-300"></div>--}}
    <span>
        {{ $atlete->last_name }}
        {{ $atlete->first_name }}
    </span>
</div>


