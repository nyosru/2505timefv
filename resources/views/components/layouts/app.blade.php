<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Время побед!') }}</title>
    {{--    <script src="https://cdn.tailwindcss.com"></script>--}}
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">--}}

    <link href="/css/output.css?v=2{{ filemtime(public_path('/css/output.css')) }}" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" rel="stylesheet">

    {{--    <script>--}}
    {{--        tailwind.config = {--}}
    {{--            theme: {--}}
    {{--                extend: {--}}
    {{--                    colors: {--}}
    {{--                        primary: '#e10600',--}}
    {{--                        secondary: '#1d4ed8',--}}
    {{--                        dark: '#1e293b',--}}
    {{--                        light: '#f8fafc'--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            }--}}
    {{--        }--}}
    {{--    </script>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 text-dark">
<!-- Шапка сайта -->
<livewire:app.header/>
<livewire:app.navigation/>

@permission('р.Техничка')
{{--<livewire:app.menu type="tech"/>--}}
<livewire:app.menu-app type="tech"/>
@endpermission

<div class="container mx-auto">
    {{ $slot ?? ''}}
</div>

@if(1==2)

    <!-- Баннер -->
    <div class="bg-gradient-to-r from-primary to-secondary text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>Чемпионат мира по футболу 2023 начинается через 15 дней! <a href="#" class="font-bold underline">Подробнее</a>
            </p>
        </div>
    </div>

    <!-- Основной контент -->
    <main class="container mx-auto px-4 py-6">
        <!-- Главная новость -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="md:flex">
                <div class="md:flex-shrink-0 md:w-1/2">
                    {{--                <img class="h-64 w-full object-cover md:h-full" src="https://picsum.photos/800/500? sports" alt="Главная новость">--}}
                    <img class="h-64 w-full object-cover md:h-full"
                         src="https://imgholder.ru/800x500/bebeaa&font=kelson&test=sprot" alt="Главная новость">
                </div>
                <div class="p-6">
                    <div class="uppercase tracking-wide text-sm text-primary font-bold">Футбол • 25 минут назад</div>
                    <a href="#" class="block mt-1 text-lg leading-tight font-medium hover:text-primary">Сборная России
                        одержала победу в товарищеском матче против Бразилии со счетом 3:2</a>
                    <p class="mt-3 text-gray-600">В напряженном матче сборная России смогла одержать победу над одним из
                        фаворитов мирового футбола. Героем встречи стал Артем Дзюба, оформивший дубль.</p>
                    <div class="flex mt-4 items-center">
                        <div class="flex space-x-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <div class="ml-2 text-gray-500">4.5/5 • 128 комментариев</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Сетка новостей -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Новость 1 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                {{--            <img class="h-48 w-full object-cover" src="https://picsum.photos/400/300? sports1" alt="Новость 1">--}}
                <img class="h-48 w-full object-cover" src="https://imgholder.ru/400x300/bebeaa&font=kelson&test=sprot"
                     alt="Новость 1">
                <div class="p-4">
                    <div class="text-xs text-primary font-semibold">Хоккей • 1 час назад</div>
                    <h3 class="font-bold text-lg mt-1 hover:text-primary">КХЛ: СКА в овертайме обыграл ЦСКА в московском
                        дерби</h3>
                    <p class="text-gray-600 mt-2">В принципиальном противостоянии двух столичных клубов победу одержали
                        хоккеисты СКА.</p>
                </div>
            </div>

            <!-- Новость 2 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                {{--            <img class="h-48 w-full object-cover" src="https://picsum.photos/400/300? sports2" alt="Новость 2">--}}
                <img class="h-48 w-full object-cover" src="https://imgholder.ru/400x300/bebeaa&font=kelson&test=sprot"
                     alt="Новость 2">
                <div class="p-4">
                    <div class="text-xs text-primary font-semibold">Теннис • 3 часа назад</div>
                    <h3 class="font-bold text-lg mt-1 hover:text-primary">Даниил Медведев вышел в полуфинал US Open</h3>
                    <p class="text-gray-600 mt-2">Российский теннисист уверенно прошел испанского соперника в трех
                        сетах.</p>
                </div>
            </div>

            <!-- Новость 3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                {{--            <img class="h-48 w-full object-cover" src="https://picsum.photos/400/300? sports3" alt="Новость 3">--}}
                <img class="h-48 w-full object-cover" src="https://imgholder.ru/400x300/bebeaa&font=kelson&test=sprot"
                     alt="Новость 3">
                <div class="p-4">
                    <div class="text-xs text-primary font-semibold">Баскетбол • 5 часов назад</div>
                    <h3 class="font-bold text-lg mt-1 hover:text-primary">Лука Дончич установил рекорд лиги по
                        количеству очков за матч</h3>
                    <p class="text-gray-600 mt-2">Словенский баскетболист набрал 58 очков в матче против "Лейкерс".</p>
                </div>
            </div>
        </div>

        <!-- Видео-блок -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold border-b-2 border-primary pb-2 mb-4">Спортивные видео</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative pb-[56.25%] h-0">
                        <img class="absolute inset-0 w-full h-full object-cover"
                             src="https://picsum.photos/600/400? sports4" alt="Видео 1">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-primary rounded-full p-4 bg-opacity-80">
                                <i class="fas fa-play text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg hover:text-primary">Обзор матча Россия - Бразилия</h3>
                        <p class="text-gray-600">Все голы и лучшие моменты товарищеского матча</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative pb-[56.25%] h-0">
                        <img class="absolute inset-0 w-full h-full object-cover"
                             src="https://picsum.photos/600/400? sports5" alt="Видео 2">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-primary rounded-full p-4 bg-opacity-80">
                                <i class="fas fa-play text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg hover:text-primary">Интервью с тренером сборной</h3>
                        <p class="text-gray-600">Валерий Карпин о победе над Бразилией и планах на чемпионат мира</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endif

<!-- Футер -->
<livewire:app.footer/>


<!-- Кнопка "Наверх" -->
<div class="fixed bottom-4 right-4 bg-primary text-white p-3 rounded-full shadow-lg hover:bg-red-800">
    <i class="fas fa-arrow-up"></i>
</div>


@livewireScripts
@stack('scripts')

</body>
</html>



@if(1==2)
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Время побед!') }}</title>

        <link rel="icon" href="/favicons/favicon.ico"> <!-- 32×32 -->
        {{--    <link rel="icon" href="images/favicons/icon.svg" type="image/svg+xml">--}}
        <link rel="apple-touch-icon" href="/favicons/apple-touch-icon.png">  <!-- 180×180 -->
        <link rel="manifest" href="/favicons/site.webmanifest">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

        <!-- Styles -->
        {{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

        <link href="/css/output.css?v=2{{ filemtime(public_path('/css/output.css')) }}" rel="stylesheet"/>
        {{--    @livewireStyles--}}

        <link href="https://use.fontawesome.com/releases/v6.2.0/css/all.css" rel="stylesheet">
        {{--    @stack('styles')--}}

        {{--    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">--}}
        {{--    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>--}}

        <meta name="csrf-token" content="{{ csrf_token() }}">


    </head>
    <body class="antialiased font-sans
{{--bg-gray-100 --}}
min-h-screen">
    <div class=" ">
        <div class="min-h-screen flex flex-col relative">
            <div
                    class="
{{--    bg-blue-100 bg-contain bg-no-repeat bg-center sm:bg-[url('/img/bg1.jpg')] --}}
    flex-grow flex-col space-y-5
    ">
                {{--        <livewire:app.header/>--}}
                <livewire:app.navigation/>
                {{--111--}}
                {{--            <livewire:informer/>--}}


                <div class="container mx-auto">
                    <div class="flex flex-col md:flex-row px-5 sm:p-0 sm:space-x-5">

                        @permission('р.Техничка')
                        <livewire:app.menu/>
                        @endpermission

                        <div class="flex-1 min-h-[400px]">
                            {{ $slot }}
                        </div>

                    </div>
                </div>

                <livewire:app.footer/>
            </div>

        </div>
    </div>

    @livewireScripts
    @stack('scripts')
    </body>
    </html>
@endif