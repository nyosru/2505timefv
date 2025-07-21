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

    <link href="/css/output.css?v={{ filemtime(public_path('/css/output.css')) }}" rel="stylesheet">
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
        <div class="
{{--    bg-blue-100 bg-contain bg-no-repeat bg-center sm:bg-[url('/img/bg1.jpg')] --}}
    flex-grow flex-col space-y-5

    ">
            {{--        <livewire:app.header/>--}}
            <livewire:app.navigation/>

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
