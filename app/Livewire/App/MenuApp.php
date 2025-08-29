<?php

namespace App\Livewire\App;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class MenuApp extends Component
{

    public $type = '';
    public $menus = [];

    public function mount()
    {

//{{--                               :active="( Request::routeIs('tech') || Request::is('tech*')   || Request::is('/')  )" --}}

        if ($this->type == 'tech') {
            $this->menus = [
                [
                    'label' => "Тех. отдел",
                    'route' => "tech.index",
//                    'active' => (Request::routeIs('tech') || Request::is('tech*')),
                    'permissions' => 'р.Техничка',
                ],
//                ['name' => 'About', 'url' => 'about'],
//                ['name' => 'Contact', 'url' => 'contact'],


                [
                    'label' => "Доски",
                    'route' => "board",
//                    'active' => (Request::routeIs('board') || Request::is('board*')),
                    'permissions' => 'р.Доски',
                ],


//        @if(1==2)
//            <div class="w-full">
//                <a href="{{ route('tech.user_list') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//{{--                {{ Request::routeIs ('tech.role_permission') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Управление ролями</span>
//                </a>
//            </div>
//            @endif
//
//        @permission('р.НовостиАдмин')
//        <livewire:app.menuItem :label="'Новости Админ'" routeName="admin.news"/>
//        @endpermission

                [
                    'label' => "Новости",
                    'route' => "admin.news",
//                    'active' => (Request::routeIs('admin.news') || Request::is('admin.news*')),
                    'permissions' => 'р.НовостиАдмин',
                ],


//        @if(2==3)
//            <div class="w-full">
//                <a href="{{ route('admin.events') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.events') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Мероприятия Админ</span>
//                </a>
//            </div>
//
//            <div class="w-full">
//                <a href="{{ route('admin.events.form') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.events') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Мероприятия Админ Добавить</span>
//                </a>
//            </div>
//            @endif
//
//        @permission('р.Мероприятия')
//        <livewire:app.menuItem label="Мероприятия Админ" routeName="admin.events"/>
//        @endpermission
//

                [
                    'label' => "Мероприятия",
                    'route' => "admin.events",
                    'active' => (Request::routeIs('admin.events') || Request::is('admin.events*')),
                    'permissions' => 'р.Мероприятия',
                ],


//        @permission('р.Мероприятия / добавить')
//        <livewire:app.menuItem label="Мероприятия Добавить" routeName="admin.events.form"/>
//        @endpermission
//

                [
                    'label' => "+Мероприятие",
                    'route' => "admin.events.form",
//                    'active' => (Request::routeIs('admin.events.form') || Request::is('admin.events.form*')),
                    'permissions' => 'р.Мероприятия / добавить',
                ],


//
//        @if(2==3)
//            <div class="w-full">
//                <a href="{{ route('admin.athletes') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.athletes') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Спортсмены Админ</span>
//                </a>
//            </div>
//            @endif
//
//        @if(2==3)
//            <div class="w-full">
//                <a href="{{ route('admin.athletes.form') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.athletes.form') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Спортсмены Админ Добавить</span>
//                </a>
//            </div>
//            @endif
//
//        <livewire:app.menuItem label="Спортсмены Админ" routeName="admin.athletes"/>
                [ 'label' => "Спортсмены", 'route' => "admin.athletes",
                //    'permissions' => 'р.НовостиАдмин'
                ],
//        <livewire:app.menuItem label="Спортсмены Админ Добавить" routeName="admin.athletes.form"/>
                [ 'label' => "+Спортсмен", 'route' => "admin.athletes.form", 'permissions' => 'р.НовостиАдмин' ],
//
//        <livewire:app.menuItem label="Гости Админ" routeName="admin.guest.manager"/>
                [ 'label' => "Гости", 'route' => "admin.guest.manager",
                //    'permissions' => 'р.НовостиАдмин'
                ],
//        <livewire:app.menuItem label="Спонсоры Админ" routeName="admin.sponsor.manager"/>
                [ 'label' => "Спонсоры", 'route' => "admin.sponsor.manager",
                //    'permissions' => 'р.НовостиАдмин'
                ],








//        @if(2==3)
//            <div class="w-full">
//                <a href="{{ route('admin.sport-types') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.sport-types') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Виды спорта Админ</span>
//                </a>
//            </div>
//            @endif
//
//        @permission('р.Виды спорта')
//        <livewire:app.menuItem label="Виды спорта" routeName="admin.sport-types"/>
//        @endpermission
                [ 'label' => "Виды спорта", 'route' => "admin.sport-types",
                        'permissions' => 'р.Виды спорта'
                ],
//        @permission('р.Страны')
//        <livewire:app.menuItem label="Страны" routeName="admin.countries"/>
//        @endpermission
                [ 'label' => "Страны", 'route' => "admin.countries",
                        'permissions' => 'р.Страны'
                ],
//        @permission('р.Города')
//        <livewire:app.menuItem label="Города" routeName="admin.cities"/>
//        @endpermission
                [ 'label' => "Города", 'route' => "admin.cities",
                    'permissions' => 'р.Города'
                ],
//        @permission('р.Место проведения')
//        <livewire:app.menuItem label="Место проведения" routeName="admin.sport-places"/>
//        @endpermission
                [ 'label' => "Места проведения", 'route' => "admin.sport-places",
                    'permissions' => 'р.Место проведения'
                ],
//
//        @if(2==3)
//            <div class="w-full">
//                <a href="{{ route('admin.countries') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.countries') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Страны Админ</span>
//                </a>
//            </div>
//            @endif
//
//        @if(2==3)
//            <div class="w-full">
//                <a href="{{ route('admin.cities') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.cities') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Города Админ</span>
//                </a>
//            </div>
//            @endif
//
//
//        @if(2==3)
//            <div class="w-full">
//                <a href="{{ route('admin.sport-places') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.sport-places') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>СпортМеста Админ</span>
//                </a>
//            </div>
//            @endif
//
//        @if(2==3)
//            <div class="w-full">
//                <a href="{{ route('admin.event-participants') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//{{--                {{ Request::is('admin.news*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//                {{ Request::routeIs('admin.event-participants') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Кто в каких мероприятиях участвовал (победил) Админ</span>
//                </a>
//            </div>
//            @endif
//
//        @if(1==2)
//
//            {{--        первая--}}
//            {{--       <div class="w-full">--}}
//            {{--            <a href="{{ route('cms2.index') }}"--}}
//            {{--               wire:navigate--}}
//            {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700 --}}
//            {{--                {{ Request::routeIs('cms2.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
//            {{--            >--}}
//            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//            {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
//            {{--                </svg>--}}
//            {{--                <span>Навигатор</span>--}}
//            {{--            </a>--}}
//            {{--       </div>--}}
//
//

//                [ 'label' => "Рабочие доски", 'route' => "leed.list",
//                    'permissions' => 'р.Лиды'
//                ],


//            <!-- Лиды -->
//            @permission('р.Лиды')
//            <div class="w-full">
//                <a href="{{ route('leed.list') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//                {{ Request::is('leed*') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Рабочие доски</span>
//                </a>
//            </div>
//            @endpermission
//
//            <!-- Клиенты -->
//            {{--        @can('р.Клиенты')--}}
//            @permission('р.Клиенты')
//            <div class="w-full">
//                <a href="{{ route('clients') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//                {{ Request::is('clients*') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                         fill="currentColor">
//                        <path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zm-3 8a7 7 0 00-5.4 2.6A8 8 0 1016 9a7 7 0 00-6 6z"/>
//                    </svg>
//                    <span>Клиенты</span>
//                </a>
//            </div>
//            @endpermission
//
//            @if(1==2)
//                <!-- Усдуги -->
//                @permission('р.Заказы')
//                <div class="w-full">
//                    <a href="{{ route('order.index') }}"
//                       wire:navigate
//                       class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//                {{ Request::routeIs('order.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"
//            >
//                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                             fill="currentColor">
//                            <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>
//                        </svg>
//                        <span>Заказы</span>
//                    </a>
//                </div>
//            @endpermission
//
//            @endif
//
//            <!-- Усдуги -->
//            {{--        @permission('р.Услуги')--}}
//            {{--       <div class="w-full">--}}
//            {{--            <a href="{{ route('uslugi.index') }}"--}}
//            {{--               wire:navigate--}}
//            {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700--}}
//            {{--                {{ Request::routeIs('uslugi.index') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
//            {{--            >--}}
//            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//            {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
//            {{--                </svg>--}}
//            {{--                <span>Услуги</span>--}}
//            {{--            </a>--}}
//            {{--       </div>--}}
//            {{--        @endpermission--}}
//
//            <!-- Сотрудники -->
//            {{--        @can('р.Сотрудники')--}}
//            {{--        @permission('р.Сотрудники')--}}
//            {{--       <div class="w-full">--}}
//            {{--            <a href="{{ route('staff.index') }}"--}}
//            {{--               wire:navigate--}}
//            {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700--}}
//            {{--                {{ Request::is('staff*') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
//            {{--            >--}}
//            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//            {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
//            {{--                </svg>--}}
//            {{--                <span>Сотрудники</span>--}}
//            {{--            </a>--}}
//            {{--       </div>--}}
//            {{--        @endpermission--}}
//
//
//            <!-- Договора -->
//            {{--        @permission('р.Договора')--}}
//            {{--       <div class="w-full">--}}
//            {{--            <a href="{{ route('dogovor.index') }}"--}}
//            {{--               wire:navigate--}}
//            {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700--}}
//            {{--                {{ Request::is('dogovor*') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//            {{--                "--}}
//            {{--            >--}}
//            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//            {{--                    <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 2h8v8H6V6z"/>--}}
//            {{--                </svg>--}}
//            {{--                <span>Договора</span>--}}
//            {{--            </a>--}}
//
//
//            {{--            @permission('р.Договора / Шаблоны')--}}
//            {{--            <ul class="ml-[20px] nav nav-treeview w-100">--}}
//
//            {{--               <div class="nav-item w-100 ">--}}
//            {{--                    <a href="{{ route('dogovor.template') }}"--}}
//            {{--                       wire:navigate--}}
//            {{--                       --}}{{--                       class="nav-link {{ request()->routeIs('buh.zakazs') ? 'active' : '' }}"--}}
//            {{--                       class="flex items-center--}}
//            {{--                        m-1 px-4 py-1 xtext-gray-700 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700--}}
//            {{--                {{ Request::routeIs('dogovor.template') ? 'bg-orange-300 text-gray-700 ' : '' }}--}}
//            {{--                "--}}
//            {{--                    >--}}
//            {{--                        --}}{{--                    <i class="nav-icon bi bi-circle"></i>--}}
//            {{--                        Шаблоны--}}
//            {{--                    </a>--}}
//            {{--               </div>--}}
//            {{--            </ul>--}}
//            {{--            @endpermission--}}
//            {{--       </div>--}}
//            {{--        @endpermission--}}
//
//            <!-- Бухгалтерия -->
//            @if(1==2)
//                @anyPermission('р.Бух.Заказы','р.Бух.Услуги','р.Бух.Счета')
//                <div class="w-full">
//                    <div
//                            {{--            <a href="{{ route('buh.zakazs') }}"--}}
//                            class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//                {{ Request::is('buh*') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                ">
//                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                             fill="currentColor">
//                            <path
//                                    d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm4 6h6a1 1 0 110 2H9a1 1 0 110-2z"/>
//                        </svg>
//                        <span>Бухгалтерия</span>
//                        {{--            </a>--}}
//                    </div>
//
//
//                    <ul class="ml-[20px] nav nav-treeview w-100">
//
//            @permission('р.Бух.Заказы')
//                        <div class="nav-item w-100 ">
//                            <a href="{{ route('buh.zakazs') }}"
//                               wire:navigate
//                               {{--                       class="nav-link {{ request()->routeIs('buh.zakazs') ? 'active' : '' }}"--}}
//                               class="flex items-center
//                        m-1 px-4 py-1 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//                {{ Request::routeIs('buh.zakazs') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                "
//            >
//                                {{--                    <i class="nav-icon bi bi-circle"></i>--}}
//                                Заказы
//                                </a>
//                        </div>
//            @endpermission
//
//                        @permission('р.Бух.Услуги')
//                        <div class="nav-item w-100">
//                            <a href="{{ route('buh.uslugi') }}"
//                               wire:navigate
//                               class="flex items-center m-1 px-4 py-1 xtext-gray-700 rounded
//                            hover:bg-orange-200 hover:text-gray-700
//                            {{ Request::routeIs('buh.uslugi') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                        "
//
//            >
//                                {{--                    <i class="nav-icon bi bi-circle"></i>--}}
//                                Услуги
//                                </a>
//                        </div>
//            @endpermission
//
//                        @permission('р.Бух.Счета')
//                        <div class="nav-item w-100">
//                            <a href="{{ route('buh.sheta') }}"
//                               wire:navigate
//                               {{--                       class="nav-link {{ request()->routeIs('buh.sheta') ? 'active' : '' }}"--}}
//                               class="flex items-center
//                        m-1 px-4 py-1 xtext-gray-700 rounded
//                        hover:bg-orange-200 hover:text-gray-700
//                        {{ Request::routeIs('buh.sheta') ? 'bg-orange-300 text-gray-700 ' : '' }}
//                        "
//
//            >
//                                {{--                    <i class="nav-icon bi bi-circle"></i>--}}
//                                Счета
//                                </a>
//                        </div>
//            @endpermission
//                    </ul>
//                </div>
//            @endanyPermission
//            @endif
//
//            {{--        user list--}}
//            {{--        @permission('р.Пользователи')--}}
//            {{--       <div class="w-full">--}}
//            {{--            <a href="{{ route('user_list') }}"--}}
//            {{--               wire:navigate--}}
//            {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700 --}}
//            {{--                {{ Request::routeIs('user_list') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
//            {{--            >--}}
//            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//            {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
//            {{--                </svg>--}}
//            {{--                <span>Пользователи</span>--}}
//            {{--            </a>--}}
//            {{--       </div>--}}
//            {{--        @endpermission--}}
//
//            {{--        @permission('р.Права доступа')--}}
//            {{--       <div class="w-full">--}}
//            {{--            <a href="{{ route('role_permission') }}"--}}
//            {{--               wire:navigate--}}
//            {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700 --}}
//            {{--                {{ Request::routeIs('role_permission') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
//            {{--            >--}}
//            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//            {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
//            {{--                </svg>--}}
//            {{--                <span>Права доступа</span>--}}
//            {{--            </a>--}}
//            {{--       </div>--}}
//            {{--        @endpermission--}}
//
//
//            {{--        @permission('р.Поставщики лидов')--}}
//            {{--       <div class="w-full">--}}
//            {{--            <a href="{{ route('ClientSupplierManager') }}"--}}
//            {{--               wire:navigate--}}
//            {{--               class="flex items-center space-x-2 px-4 py-2 text-gray-600 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700 --}}
//            {{--                {{ Request::routeIs('ClientSupplierManager') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
//            {{--            >--}}
//            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//            {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
//            {{--                </svg>--}}
//            {{--                <span>Источники лидов</span>--}}
//            {{--            </a>--}}
//            {{--       </div>--}}
//            {{--        @endpermission--}}
//
//            {{--        @permission('тех.Управление столбцами')--}}
//            {{--       <div class="w-full">--}}
//            {{--            <a href="{{ route('adm_role_column') }}"--}}
//            {{--               wire:navigate--}}
//            {{--               class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded--}}
//            {{--                hover:bg-orange-200 hover:text-gray-700 --}}
//            {{--                {{ Request::routeIs('adm_role_column') ? 'bg-orange-300 text-gray-700 ' : '' }}"--}}
//            {{--            >--}}
//            {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//            {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
//            {{--                </svg>--}}
//            {{--                <span>Путь заказа, доступы</span>--}}
//            {{--            </a>--}}
//            {{--       </div>--}}
//            {{--        @endpermission--}}
//
//            @permission('р.Доски')
//            <div class="w-full">
//                <a href="{{ route('board') }}"
//                   wire:navigate
//                   class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded
//                hover:bg-orange-200 hover:text-gray-700
//                {{ Request::is('board*') ? 'bg-orange-300 text-gray-700 ' : '' }}"
//            >
//                    {{--                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">--}}
//                    {{--                    <path d="M10 11a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z"/>--}}
//                    {{--                </svg>--}}
//                    <img src="/icon/gear.svg" class="w-[18px]"/>
//                    <span>Доски</span>
//                </a>
//            </div>
//            @endpermission
//
//
//            <!-- CRM -->
//            @if(1==2)
//                <div class="w-full">
//
//
//            @if (App::environment('local'))
//                        <a href="https://crm.marudi.store"
//                           class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded hover:bg-orange-200 hover:text-gray-700                "
//                           target="_blank"
//                               >
//                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                                 fill="currentColor">
//                                <path
//                                        d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l4.546 8.09c.717 1.277-.17 2.81-1.742 2.81H5.453c-1.573 0-2.46-1.533-1.742-2.81l4.546-8.09zM11 13a1 1 0 11-2 0 1 1 0 012 0z"/>
//                            </svg>
//                            <span>Перейти на crm.marudi.store</span>
//                        </a>
//            @else
//                        <a href="https://marudi.store"
//                           class="flex items-center space-x-2 px-4 py-2 xtext-gray-700 rounded hover:bg-orange-200 hover:text-gray-700                "
//                           target="_blank"
//                               >
//                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
//                                 fill="currentColor">
//                                <path
//                                        d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l4.546 8.09c.717 1.277-.17 2.81-1.742 2.81H5.453c-1.573 0-2.46-1.533-1.742-2.81l4.546-8.09zM11 13a1 1 0 11-2 0 1 1 0 012 0z"/>
//                            </svg>
//                            <span>marudi.store</span>
//                        </a>
//            @endif
//                </div>
//            @endif
//        @endif
//
//
//        @endpermission
//
//
//        </ul>
//
//    </div>
//</div>
//
//{{--    <script>--}}
//{{--        function initMenuToggle() {--}}
//    {{--            const btn = document.getElementById('menu-toggle');--}}
//    {{--            const menu = document.getElementById('mobile-menu');--}}
//
//    {{--            if (!btn || !menu) return;--}}
//
//    {{--            // Удаляем старый обработчик, чтобы не навешивать несколько раз--}}
//{{--            btn.replaceWith(btn.cloneNode(true));--}}
//{{--            const newBtn = document.getElementById('menu-toggle');--}}
//
//{{--            newBtn.addEventListener('click', () => {--}}
//    {{--                menu.classList.toggle('hidden');--}}
//    {{--            });--}}
//{{--        }--}}
//
//        {{--        document.addEventListener('DOMContentLoaded', () => {--}}
//            {{--            initMenuToggle();--}}
//            {{--        });--}}
//
//        {{--        // Livewire 3 событие после навигации--}}
//{{--        document.addEventListener('livewire:navigated', () => {--}}
//    {{--            initMenuToggle();--}}
//    {{--        });--}}
//{{--    </script>--}}
//
//</div>


            ];

//            'access' => Auth()->user->hasPermissionTo('р.Деньги / видеть удалённые записи')) {


//                    'active' => (Request::routeIs('admin.events.form') || Request::is('admin.events.form*')),


        }

        if (!empty($this->menus)) {
            foreach ($this->menus as $k => $menu) {

                if (!empty($menu['permissions'])) {
                    $user = Auth::user();
                    if( !$user->hasPermissionTo($menu['permissions']) ){
                        continue;
                    }
                }


                if (empty($menu['active'])) {
                    $this->menus[$k]['active'] = (Request::routeIs($menu['route']) || Request::is($menu['route'] . '*'));
                }
            }
        }

    }


    public function render()
    {
        return view('livewire.app.menu-app');
    }
}
