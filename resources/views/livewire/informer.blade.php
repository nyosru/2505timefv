<div>
{{--    <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r(Auth::user()->toArray()) }}</pre>--}}
    @if( !empty($ar1) )
    <pre class="max-h-[200px] overflow-auto text-xs">{{ print_r($ar1->toArray()) }}</pre>
        @endif
</div>
