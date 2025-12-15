<header class="bg-white shadow-md text-gray-400">



    <div class="flag-container-blurred">
        <!-- Фон с мягкими переходами -->
        <div class="flag-gradient-blurred"></div>

        <!-- Контент -->
        <div class="content">
{{--            <h1>Новый сайт</h1>--}}
{{--            <p>С анимированным триколором</p>--}}

    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center">
{{--            <h1 class="text-2xl md:text-3xl font-bold text-primary">Sport<span class="text-secondary">News</span></h1>--}}
            <a href="/" class="text-[2.5rem] font-bold text-red-600">
                <nobr>ВремяПобед<span class="text-[1.5rem]">.рус</span></nobr>
                {{--                <img src="/img/logo1.svg" class="h-[60px]" alt="" />--}}
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <div class="hidden md:flex space-x-2">
{{--                <button class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-full">--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                </button>--}}
{{--                <button class="bg-primary hover:bg-red-800 px-3 py-1 rounded-full text-white">--}}
{{--                    Войти--}}
{{--                </button>--}}

{{--                @if (Route::has('login'))--}}
{{--                    <livewire:app.navigation/>--}}
{{--                @endif--}}



                @guest
                    @if(1==1)
                        {!! Socialite::driver('telegram')->getButton() !!}
                    @endif
                @else
                    {{--                <div>--}}
                    <!-- Authentication -->
                    {{--    {{ auth()->user()->name ?? '-' }}--}}
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="inline xw-full text-start">
                            {{ auth()->user()->name ?? '-' }}
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute
                            {{--                        bg-white--}}
                            {{--                         bg-orange-300--}}
                             border-2 border-gray-500
{{--                             rounded--}}
                             rounded-xl
{{--                             shadow-lg --}}
                             z-10">
                            <div class="flex flex-col w-[150px] ">
                                <div class="">
                                    <a href="{{ route('lk.profile') }}"
                                       class="block bg-white px-4 py-2
                                        hover:bg-orange-200 hover:underline
                                        "
                                    >
                                        Профиль
                                    </a>
                                </div>
                                <div

                                >
                                    <a
                                            href="{{ route('logout',['r'=>rand()]) }}"
                                            class=" bg-white px-4 py-2 hover:underline block
                                        hover:bg-orange-200
                                        "

                                    >
                                        Выйти
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                </div>--}}

                @endif


            </div>
            <button class="md:hidden text-gray-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

        </div>
    </div>

    <style>
        .flag-container-blurred {
            position: relative;
            width: 100%;
            /*min-height: 300px;*/
            overflow: hidden;
            /*border-radius: 20px;*/
            /*box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);*/
        }

        .flag-gradient-blurred {
            position: absolute;
            inset: 0;
            /* Плавные градиенты с размытыми переходами */
            background:
                    linear-gradient(
                            45deg,
                            #ffffff 0%,
                            rgba(255, 255, 255, 0.9) 20%,
                            rgba(255, 255, 255, 0.7) 30%,
                            rgba(197, 215, 253, 0.7) 40%,
                            #82aeff 50%,
                            rgba(167, 200, 255, 0.7) 60%,
                            rgba(255, 192, 183, 0.7) 70%,
                            #cc8c89 80%,
                            rgba(216, 157, 153, 0.9) 90%
                    );
            background-size: 400% 400%;
            /*animation: smoothFlagMove 25s ease infinite;*/
            animation: smoothFlagMove 75s ease infinite;

            /* Эффекты размытия */
            filter: blur(2px);
            backdrop-filter: blur(3px);

        }

        .content {
            position: relative;
            z-index: 10;
            /*height: 100%;*/
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /*padding: 2rem;*/
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        .content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(
                    to right,
                    rgba(255, 255, 255, 0.9),
                    rgba(255, 255, 255, 0.7)
            );
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        @keyframes smoothFlagMove {
            0% {
                background-position: 0% 50%;
                filter: blur(2px) hue-rotate(0deg);
            }
            33% {
                background-position: 100% 25%;
                filter: blur(3px) hue-rotate(5deg);
            }
            66% {
                background-position: 50% 100%;
                filter: blur(2px) hue-rotate(-5deg);
            }
            100% {
                background-position: 0% 50%;
                filter: blur(2px) hue-rotate(0deg);
            }
        }

        /* Эффект свечения границ */
        .flag-container-blurred::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(
                    45deg,
                    rgba(255, 255, 255, 0.2),
                    rgba(0, 57, 166, 0.2),
                    rgba(213, 43, 30, 0.2)
            );
            border-radius: 22px;
            z-index: -1;
            filter: blur(15px);
            opacity: 0.6;
            animation: borderGlow 4s ease-in-out infinite alternate;
        }

        @keyframes borderGlow {
            from {
                opacity: 0.4;
                filter: blur(10px);
            }
            to {
                opacity: 0.8;
                filter: blur(20px);
            }
        }
    </style>




@if(1==2)
        <header class="
        bg-gradient-to-bl from-gray-100 to-blue-200
        py-5
{{--        flex flex-col--}}
        ">

            <div class="container mx-auto text-center
            flex
            flex-col
            sm:flex-row
{{--            border-red-300 border-2--}}
            ">
                <div class="w-full sm:w-1/3 text-center text-2xl font-bold font-monospace py-3">
                    <a href="/" class="hover:underline">
                        Пр
                        <svg class="inline-block w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        цессМастер<small>.рф</small>
                    </a>
                </div>
                <div class="w-2/3 text-right py-3">
                    @if (Route::has('login'))
                        <livewire:app.navigation/>
                    @endif
                </div>
            </div>

        </header>
    @endif
</header>
