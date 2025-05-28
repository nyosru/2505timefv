<div class="flex flex-row items-center
{{--gap-2 mb-4--}}
">

    {{--    <pre>{{ print_r($athlete->toArray(), true) }}</pre>--}}
    {{-- Care about people's approval and you will be their prisoner. --}}

    @if( !empty($athlete->pivot->place) )
        <div>
            <img
{{--                    src="{{ asset('img/medal'. $athlete->pivot->place .'.png' ) }}"--}}
                    src="{{ asset('img/m'. $athlete->pivot->place .'.png' ) }}"
                 class="w-[56px]"
                 alt=""/>
        </div>
    @else
        <div class="w-[24px]">
            &nbsp;
        </div>
    @endif

    <div class="align-left         @if( !empty($athlete->pivot->place) ) font-bold text-lg @endif ">
        {{ $athlete->last_name }}
        {{ $athlete->first_name }}
        {{ $athlete->middle_name }}
        {{--    <br/>--}}
        {{--    place:--}}
        {{--    {{ $athlete->pivot->place }}--}}
    </div>
</div>
