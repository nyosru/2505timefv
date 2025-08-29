<span
{{--        class="w-full"--}}
>
    @if(Route::has($routeName))
        <a href="{{ route($routeName) }}"
           wire:navigate
           class="flex items-center
               px-3 py-0
{{--           xtext-gray-700--}}
{{--           space-x-2 --}}
                rounded-xl
                border-2
                border-transparent
                hover:border-red-700

                {{ $active ? 'bg-red-700 text-white ' : '' }}
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
{{--                {{ Request::routeIs($routeName) ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                "
        >
            @if( !empty($icon) )
                {{ $icon }}
            @else
                {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                {{--                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>--}}
                {{--                </svg>--}}
            @endif

            <span>{{ $label ?? '--' }}</span>
        </a>
    @endif
</span>

