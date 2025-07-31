<div>
    <div class="mb-5">
        <livewire:Cms2.App.Breadcrumb
                :menu="[
                                ['route'=>'tech.index','name'=>'Техничка'],
{{--                                ['route'=>'tech.product-type-manager','name'=>'Типы изделий'],--}}
{{--                                [ 'link'=>'no', 'name'=>'Счета']--}}
                                ]"/>

    </div>

    <div class="flex flex-wrap">
        @foreach( $links as $name => $v )

            @if( !empty($v['permission']) )
                {{--            11 /<br/>--}}
                {{--            {{$v['route']}} /<br/>--}}
                {{--            {{route($v['route'])}}--}}
                {{--        <br/>--}}

                @permission($v['permission'])

                <a href="{{route($v['route'])}}"
                   wire:navigate
                   class="hover:bg-orange-300 bg-cyan-300 px-2 py-1 m-1 block-inline rounded"
                        {{--       wire:click.prevent="$set('show_me', 'ProductTypeManager')" --}}
                >{{ $name }}</a>

                @endpermission

            @else
                <a href="{{route($v['route'])}}"
                   wire:navigate
                   class="hover:bg-orange-300 bg-cyan-300 px-2 py-1 m-1 block-inline rounded"
                        {{--       wire:click.prevent="$set('show_me', 'ProductTypeManager')" --}}
                >{{ $name }}</a>
            @endif

        @endforeach
    </div>
    {{--<div class="flex flex-row">--}}
    {{--    <div class="w-1/5">--}}
    {{--<a href="#"--}}
    {{--   class="@if( $show_me == 'ProductTypeManager' ) bg-orange-400 @else bg-gray-100 @endif p-1 m-1 block"--}}
    {{--   wire:click.prevent="$set('show_me', 'ProductTypeManager')" >Тип продукции</a>--}}
    {{--    </div>--}}
    {{--    <div class="w-4/5">--}}
    {{--        @if( $show_me == 'ProductTypeManager' )--}}
    {{--            <livewire:cms2.tech.product-type-manager />--}}
    {{--        @endif--}}
    {{--    </div>--}}


    <p class="font-bold">Глобальные вещи</p>
    <div class="flex ml-5">

        @permission('р.Доски')
        <div>
            <livewire:app.menuItem :label="'Доски'" routeName="board"/>
        </div>
        @endpermission
    </div>

    <p class="font-bold">Мероприятия</p>
    <div class="flex ml-5">
        @permission('р.Мероприятия')
        <div>
            <livewire:app.menuItem label="Мероприятия" routeName="admin.events"/>
        </div>
        @endpermission

        @permission('р.Мероприятия / добавить')
        <div>
            <livewire:app.menuItem label="Добавить" routeName="admin.events.form"/>
        </div>
        @endpermission
    </div>

    <p class="font-bold">Спортсмены</p>
    <div class="flex ml-5">
        <div>
            <livewire:app.menuItem label="Спортсмены" routeName="admin.athletes"/>
        </div>
        <div>
            <livewire:app.menuItem label="Добавить" routeName="admin.athletes.form"/>
        </div>
    </div>
    <p class="font-bold">Новости</p>
    <div class="flex ml-5">
        @permission('р.НовостиАдмин')
        <div>
            <livewire:app.menuItem label="Новости" routeName="admin.news"/>
        </div>
        @endpermission
        @permission('р.Новости / добавить новость')
        <div>
{{--            [ 'route' => 'admin.news.create','name'=> ( ( $editMode ? 'Редактирование' : 'Создание' ) . ' новости' ), 'link'=>'no' ]--}}
            <livewire:app.menuItem label="Добавить" routeName="admin.news.create"/>
        </div>
        @endpermission
    </div>

    <p class="font-bold">Дополнительные данные</p>
    <div class="flex flex-wrap ml-5">
        <div>
            <livewire:app.menuItem label="Гости Админ" routeName="admin.guest.manager"/>
        </div>
        <div>
            <livewire:app.menuItem label="Спонсоры Админ" routeName="admin.sponsor.manager"/>
        </div>


        @permission('р.Виды спорта')
        <div>
            <livewire:app.menuItem label="Виды спорта" routeName="admin.sport-types"/>
        </div>
        @endpermission

        @permission('р.Страны')
        <div>
            <livewire:app.menuItem label="Страны" routeName="admin.countries"/>
        </div>
        @endpermission

        @permission('р.Города')
        <div>
            <livewire:app.menuItem label="Города" routeName="admin.cities"/>
        </div>
        @endpermission

        @permission('р.Место проведения')
        <div>
            <livewire:app.menuItem label="Место проведения" routeName="admin.sport-places"/>
        </div>
        @endpermission


    </div>

    @if(1==2)
        <div>


            <nav class="
{{--    bg-green-200 flex items-center justify-between px-4 py-2 relative--}}
    ">
                <!-- Кнопка-гамбургер -->
                <button id="menu-toggle"
                        {{--                class="md:hidden flex flex-col justify-center items-center w-10 h-10"--}}
                        class="fixed top-2 left-2 z-50 md:hidden flex flex-col justify-center items-center w-10 h-10 bg-white rounded shadow"
                        aria-label="Открыть меню">
                    <span class="block w-6 h-0.5 bg-gray-800 mb-1"></span>
                    <span class="block w-6 h-0.5 bg-gray-800 mb-1"></span>
                    <span class="block w-6 h-0.5 bg-gray-800"></span>
                </button>
            </nav>

            <div class="
{{--    px-1 pt-5 --}}
    text-gray-600 md:block md:w-[200px]">
                <div class="flex flex-col space-y-1">
                    <ul id="mobile-menu"
                        md:max-h-[9999px] md:overflow-none
                    "
                    >

                    @if(1==2)

                        {{--            @permission('р.Доски')--}}
                        <livewire:app.menuItem label="Новости" routeName="news"
                                               :active="( Request::routeIs('news') || Request::is('news*')   || Request::is('/')  )"/>
                        {{--            @endpermission--}}

                        @if(1==2)
                            <li class="w-full">
                                <a href="{{ route('news') }}"
                                   wire:navigate
                                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{--                class="hidden w-full bg-white shadow-md flex-col md:static md:flex md:flex-col md:shadow-none"--}}
                class=" hidden fixed top-14 left-2 right-2 bg-white shadow-lg rounded z-40 flex flex-col space-y-0 p-2
                                   {{--                md:hidden--}}
                                   md:static md:flex
                                   md:bg-transparent md:shadow-none
                                   max-h-[70vh] overflow-y-auto
                                {{ Request::is('news*') ? ' bg-orange-300 text-gray-700 ' : '' }}
                                {{ Request::routeIs('login') ? ' bg-orange-300 text-gray-700 ' : '' }}
                                "
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Новости</span>
                                </a>
                            </li>
                        @endif


                        <li class="w-full">
                            <a href="{{ route('events.index') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('events*') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Мероприятия</span>
                            </a>
                        </li>


                        <li class="w-full">
                            <a href="{{ route('athletes.index') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('athletes.index') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Спортсмены</span>
                            </a>
                        </li>

                    @endif

                    {{--<pre class="text-xs">{{ print_r(Auth::user()->roles()->toArray(),1)  }}</pre>--}}


                    @permission('р.Техничка')

                    <li>
                        <h2>Админ Меню</h2>
                    </li>


                    <li class="w-full bg-gray-300 py-1 px-2">
                        @if(1==2)
                            <a href="{{ route('tech.index') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('tech*') ? 'bg-orange-300 text-gray-700 ' : '' }}"
                            >
                                {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                                {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                                {{--                </svg>--}}
                                <img src="/icon/gear.svg" class="w-[18px]"/>
                                <span>Тех. отдел</span>
                            </a>
                        @endif
                    </li>

                    <livewire:app.menuItem label="Тех. отдел" routeName="tech.index"/>

                    @if(1==2)
                        <li class="w-full">
                            <a href="{{ route('tech.role_permission') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
{{--                {{ Request::routeIs ('tech.role_permission') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Управление ролями</span>
                            </a>
                        </li>
                    @endif

                    @if(2==3)
                        <livewire:app.menuItem label="Управление ролями" routeName="tech.role_permission"/>
                    @endif
                    {{--            <livewire:app.menuItem :label="'Управление пользователями'" routeName="tech.user_list"/>--}}






                    @if(1==2)
                        <li class="w-full">
                            <a href="{{ route('tech.user_list') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
{{--                {{ Request::routeIs ('tech.role_permission') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Управление ролями</span>
                            </a>
                        </li>
                    @endif


                    @if(1==2)
                        <li class="w-full">
                            <a href="{{ route('admin.news') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.news') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Новости Админ</span>
                            </a>
                        </li>
                    @endif


                    @if(2==3)
                        <li class="w-full">
                            <a href="{{ route('admin.events') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.events') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Мероприятия Админ</span>
                            </a>
                        </li>

                        <li class="w-full">
                            <a href="{{ route('admin.events.form') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.events') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Мероприятия Админ Добавить</span>
                            </a>
                        </li>
                    @endif


                    @if(2==3)
                        <li class="w-full">
                            <a href="{{ route('admin.athletes') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.athletes') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Спортсмены Админ</span>
                            </a>
                        </li>
                    @endif

                    @if(2==3)
                        <li class="w-full">
                            <a href="{{ route('admin.athletes.form') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.athletes.form') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Спортсмены Админ Добавить</span>
                            </a>
                        </li>
                    @endif

                    @if(2==3)
                        <li class="w-full">
                            <a href="{{ route('admin.sport-types') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.sport-types') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Виды спорта Админ</span>
                            </a>
                        </li>
                    @endif


                    @if(2==3)
                        <li class="w-full">
                            <a href="{{ route('admin.countries') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.countries') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Страны Админ</span>
                            </a>
                        </li>
                    @endif

                    @if(2==3)
                        <li class="w-full">
                            <a href="{{ route('admin.cities') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.cities') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Города Админ</span>
                            </a>
                        </li>
                    @endif


                    @if(2==3)
                        <li class="w-full">
                            <a href="{{ route('admin.sport-places') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.sport-places') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>СпортМеста Админ</span>
                            </a>
                        </li>
                    @endif

                    @if(2==3)
                        <li class="w-full">
                            <a href="{{ route('admin.event-participants') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                {{ Request::routeIs('admin.event-participants') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Кто в каких мероприятиях участвовал (победил) Админ</span>
                            </a>
                        </li>
                    @endif

                    @if(1==2)

                        {{--        первая--}}
                        {{--        <li class="w-full">--}}
                        {{--            <a href="{{ route('cms2.index') }}"--}}
                        {{--               wire:navigate--}}
                        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
                        {{--                {{ Request::routeIs('cms2.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
                        {{--            >--}}
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                        {{--                </svg>--}}
                        {{--                <span>Навигатор</span>--}}
                        {{--            </a>--}}
                        {{--        </li>--}}


                        <!-- Лиды -->
                        @permission('р.Лиды')
                        <li class="w-full">
                            <a href="{{ route('leed.list') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('leed*') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Рабочие доски</span>
                            </a>
                        </li>
                        @endpermission

                        <!-- Клиенты -->
                        {{--        @can('р.Клиенты')--}}
                        @permission('р.Клиенты')
                        <li class="w-full">
                            <a href="{{ route('clients') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('clients*') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
                                </svg>
                                <span>Клиенты</span>
                            </a>
                        </li>
                        @endpermission

                        @if(1==2)
                            <!-- Усдуги -->
                            @permission('р.Заказы')
                            <li class="w-full">
                                <a href="{{ route('order.index') }}"
                                   wire:navigate
                                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::routeIs('order.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>
                                    </svg>
                                    <span>Заказы</span>
                                </a>
                            </li>
                            @endpermission

                        @endif

                        <!-- Усдуги -->
                        {{--        @permission('р.Услуги')--}}
                        {{--        <li class="w-full">--}}
                        {{--            <a href="{{ route('uslugi.index') }}"--}}
                        {{--               wire:navigate--}}
                        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700--}}
                        {{--                {{ Request::routeIs('uslugi.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
                        {{--            >--}}
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                        {{--                </svg>--}}
                        {{--                <span>Услуги</span>--}}
                        {{--            </a>--}}
                        {{--        </li>--}}
                        {{--        @endpermission--}}

                        <!-- Сотрудники -->
                        {{--        @can('р.Сотрудники')--}}
                        {{--        @permission('р.Сотрудники')--}}
                        {{--        <li class="w-full">--}}
                        {{--            <a href="{{ route('staff.index') }}"--}}
                        {{--               wire:navigate--}}
                        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700--}}
                        {{--                {{ Request::is('staff*') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
                        {{--            >--}}
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                        {{--                </svg>--}}
                        {{--                <span>Сотрудники</span>--}}
                        {{--            </a>--}}
                        {{--        </li>--}}
                        {{--        @endpermission--}}


                        <!-- Договора -->
                        {{--        @permission('р.Договора')--}}
                        {{--        <li class="w-full">--}}
                        {{--            <a href="{{ route('dogovor.index') }}"--}}
                        {{--               wire:navigate--}}
                        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700--}}
                        {{--                {{ Request::is('dogovor*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                        {{--                "--}}
                        {{--            >--}}
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                        {{--                    <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v8H6V6z"/>--}}
                        {{--                </svg>--}}
                        {{--                <span>Договора</span>--}}
                        {{--            </a>--}}


                        {{--            @permission('р.Договора / Шаблоны')--}}
                        {{--            <ul class="ml-[20px] nav nav-treeview w-100">--}}

                        {{--                <li class="nav-item w-100 ">--}}
                        {{--                    <a href="{{ route('dogovor.template') }}"--}}
                        {{--                       wire:navigate--}}
                        {{--                       --}}{{--                       class="nav-link {{ request()->routeIs('buh.zakazs') ? 'active' : '' }}"--}}
                        {{--                       class="flex items-center--}}
                        {{--                        m-1 px-4 py-1 xtext-gray-700 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700--}}
                        {{--                {{ Request::routeIs('dogovor.template') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
                        {{--                "--}}
                        {{--                    >--}}
                        {{--                        --}}{{--                    <i class="nav-icon bi bi-circle"></i>--}}
                        {{--                        Шаблоны--}}
                        {{--                    </a>--}}
                        {{--                </li>--}}
                        {{--            </ul>--}}
                        {{--            @endpermission--}}
                        {{--        </li>--}}
                        {{--        @endpermission--}}

                        <!-- Бухгалтерия -->
                        @if(1==2)
                            @anyPermission('р.Бух.Заказы','р.Бух.Услуги','р.Бух.Счета')
                            <li class="w-full">
                                <div
                                        {{--            <a href="{{ route('buh.zakazs') }}"--}}
                                        class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('buh*') ? 'bg-orange-300 text-gray-700 ' : '' }}
                ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path
                                                d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm4 6h6a1 1 0 110 2H9a1 1 0 110-2z"/>
                                    </svg>
                                    <span>Бухгалтерия</span>
                                    {{--            </a>--}}
                                </div>


                                <ul class="ml-[20px] nav nav-treeview w-100">

                                    @permission('р.Бух.Заказы')
                                    <li class="nav-item w-100 ">
                                        <a href="{{ route('buh.zakazs') }}"
                                           wire:navigate
                                           {{--                       class="nav-link {{ request()->routeIs('buh.zakazs') ? 'active' : '' }}"--}}
                                           class="flex items-center
                        m-1 px-4 py-1 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::routeIs('buh.zakazs') ? 'bg-orange-300 text-gray-700 ' : '' }}
                "
                                        >
                                            {{--                    <i class="nav-icon bi bi-circle"></i>--}}
                                            Заказы
                                        </a>
                                    </li>
                                    @endpermission

                                    @permission('р.Бух.Услуги')
                                    <li class="nav-item w-100">
                                        <a href="{{ route('buh.uslugi') }}"
                                           wire:navigate
                                           class="flex items-center m-1 px-4 py-1 xtext-gray-700 rounded
                            hover:bg-orange-200 hover:text-gray-700
                            {{ Request::routeIs('buh.uslugi') ? 'bg-orange-300 text-gray-700 ' : '' }}
                        "

                                        >
                                            {{--                    <i class="nav-icon bi bi-circle"></i>--}}
                                            Услуги
                                        </a>
                                    </li>
                                    @endpermission

                                    @permission('р.Бух.Счета')
                                    <li class="nav-item w-100">
                                        <a href="{{ route('buh.sheta') }}"
                                           wire:navigate
                                           {{--                       class="nav-link {{ request()->routeIs('buh.sheta') ? 'active' : '' }}"--}}
                                           class="flex items-center
                        m-1 px-4 py-1 xtext-gray-700 rounded
                        hover:bg-orange-200 hover:text-gray-700
                        {{ Request::routeIs('buh.sheta') ? 'bg-orange-300 text-gray-700 ' : '' }}
                        "

                                        >
                                            {{--                    <i class="nav-icon bi bi-circle"></i>--}}
                                            Счета
                                        </a>
                                    </li>
                                    @endpermission
                                </ul>
                            </li>
                            @endanyPermission
                        @endif

                        {{--        user list--}}
                        {{--        @permission('р.Пользователи')--}}
                        {{--        <li class="w-full">--}}
                        {{--            <a href="{{ route('user_list') }}"--}}
                        {{--               wire:navigate--}}
                        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
                        {{--                {{ Request::routeIs('user_list') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
                        {{--            >--}}
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                        {{--                </svg>--}}
                        {{--                <span>Пользователи</span>--}}
                        {{--            </a>--}}
                        {{--        </li>--}}
                        {{--        @endpermission--}}

                        {{--        @permission('р.Права доступа')--}}
                        {{--        <li class="w-full">--}}
                        {{--            <a href="{{ route('role_permission') }}"--}}
                        {{--               wire:navigate--}}
                        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
                        {{--                {{ Request::routeIs('role_permission') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
                        {{--            >--}}
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                        {{--                </svg>--}}
                        {{--                <span>Права доступа</span>--}}
                        {{--            </a>--}}
                        {{--        </li>--}}
                        {{--        @endpermission--}}


                        {{--        @permission('р.Поставщики лидов')--}}
                        {{--        <li class="w-full">--}}
                        {{--            <a href="{{ route('ClientSupplierManager') }}"--}}
                        {{--               wire:navigate--}}
                        {{--               class="flex items-center space-x-2 px-4 py-2 text-gray-600 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
                        {{--                {{ Request::routeIs('ClientSupplierManager') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
                        {{--            >--}}
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                        {{--                </svg>--}}
                        {{--                <span>Источники лидов</span>--}}
                        {{--            </a>--}}
                        {{--        </li>--}}
                        {{--        @endpermission--}}

                        {{--        @permission('тех.Управление столбцами')--}}
                        {{--        <li class="w-full">--}}
                        {{--            <a href="{{ route('adm_role_column') }}"--}}
                        {{--               wire:navigate--}}
                        {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
                        {{--                hover:bg-orange-200 hover:text-gray-700 --}}
                        {{--                {{ Request::routeIs('adm_role_column') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
                        {{--            >--}}
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                        {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                        {{--                </svg>--}}
                        {{--                <span>Путь заказа, доступы</span>--}}
                        {{--            </a>--}}
                        {{--        </li>--}}
                        {{--        @endpermission--}}

                        @permission('р.Доски')
                        <li class="w-full">
                            <a href="{{ route('board') }}"
                               wire:navigate
                               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
                hover:bg-orange-200 hover:text-gray-700
                {{ Request::is('board*') ? 'bg-orange-300 text-gray-700 ' : '' }}"
                            >
                                {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
                                {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
                                {{--                </svg>--}}
                                <img src="/icon/gear.svg" class="w-[18px]"/>
                                <span>Доски</span>
                            </a>
                        </li>
                        @endpermission


                        <!-- CRM -->
                        @if(1==2)
                            <li class="w-full">


                                @if (App::environment('local'))
                                    <a href="https://crm.marudi.store"
                                       class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded hover:bg-orange-200 hover:text-gray-700                "
                                       target="_blank"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path
                                                    d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l4.546 8.09c.717 1.277-.17 2.81-1.742 2.81H5.453c-1.573 0-2.46-1.533-1.742-2.81l4.546-8.09zM11 13a1 1 0 11-2 0 1 1 0 012 0z"/>
                                        </svg>
                                        <span>Перейти на crm.marudi.store</span>
                                    </a>
                                @else
                                    <a href="https://marudi.store"
                                       class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded hover:bg-orange-200 hover:text-gray-700                "
                                       target="_blank"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path
                                                    d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l4.546 8.09c.717 1.277-.17 2.81-1.742 2.81H5.453c-1.573 0-2.46-1.533-1.742-2.81l4.546-8.09zM11 13a1 1 0 11-2 0 1 1 0 012 0z"/>
                                        </svg>
                                        <span>marudi.store</span>
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endif


                    @endpermission


                    </ul>

                </div>
            </div>

            {{--            <script>--}}
            {{--                function initMenuToggle() {--}}
            {{--                    const btn = document.getElementById('menu-toggle');--}}
            {{--                    const menu = document.getElementById('mobile-menu');--}}

            {{--                    if (!btn || !menu) return;--}}

            {{--                    // Удаляем старый обработчик, чтобы не навешивать несколько раз--}}
            {{--                    btn.replaceWith(btn.cloneNode(true));--}}
            {{--                    const newBtn = document.getElementById('menu-toggle');--}}

            {{--                    newBtn.addEventListener('click', () => {--}}
            {{--                        menu.classList.toggle('hidden');--}}
            {{--                    });--}}
            {{--                }--}}

            {{--                document.addEventListener('DOMContentLoaded', () => {--}}
            {{--                    initMenuToggle();--}}
            {{--                });--}}

            {{--                // Livewire 3 событие после навигации--}}
            {{--                document.addEventListener('livewire:navigated', () => {--}}
            {{--                    initMenuToggle();--}}
            {{--                });--}}
            {{--            </script>--}}

        </div>
    @endif


</div>
