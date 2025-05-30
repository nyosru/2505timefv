<nav class="
{{--flex flex-1--}}
{{--justify-end--}}
">
    @auth
        @if(1==2)
            <a
                href="{{ url(route('index')) }}"
                class="
{{--            rounded-md--}}
            px-3
{{--            py-2 --}}
            text-black ring-1 ring-transparent transition
            hover:text-black/70
            focus:outline-none focus-visible:ring-[#FF2D20]
{{--            dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white--}}
            "
            >
                Главная
            </a>
        @endif
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                         x-on:profile-updated.window="name = $event.detail.name"></div>

                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                {{--                <x-dropdown-link :href="route('index')" wire:navigate>--}}
                {{--                    {{ __('Profile') }}--}}
                {{--                </x-dropdown-link>--}}

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-dropdown-link>
                        Выход
                    </x-dropdown-link>
                </button>
            </x-slot>
        </x-dropdown>
    @else
        <a
            href="{{ route('login') }}"
            class="
{{--            rounded-md --}}
            px-3
{{--            py-2 --}}
            text-black
                ring-1 ring-transparent transition
                hover:text-black/70
                focus:outline-none focus-visible:ring-[#FF2D20]
{{--                dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white--}}
                "
        >
            Войти
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="
{{--                rounded-md --}}
                px-3
{{--                py-2--}}
                text-black ring-1 ring-transparent transition
                hover:text-black/70
                focus:outline-none focus-visible:ring-[#FF2D20]
{{--                dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white--}}
                "
            >
                Зарегистрироваться
            </a>
        @endif
    @endauth
</nav>
