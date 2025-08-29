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


                [
                    'label' => "Новости",
                    'route' => "admin.news",
//                    'active' => (Request::routeIs('admin.news*') || Request::is('admin.news')),
                    'active' => (Request::routeIs('admin.news*') ),
                    'permissions' => 'р.НовостиАдмин',
                ],

                [
                    'label' => "Мероприятия",
                    'route' => 'admin.events',
//                    'active' => (Request::routeIs('admin.events') || Request::is('admin.events*')),
                    'permissions' => 'р.Мероприятия',
                ],

                [
                    'label' => "+Мероприятие",
                    'route' => "admin.events.form",
//                    'active' => (Request::routeIs('admin.events.form') || Request::is('admin.events.form*')),
                    'permissions' => 'р.Мероприятия / добавить',
                ],

                [ 'label' => "Спортсмены", 'route' => "admin.athletes",
                //    'permissions' => 'р.НовостиАдмин'
                ],
                [ 'label' => "+Спортсмен", 'route' => "admin.athletes.form", 'permissions' => 'р.НовостиАдмин' ],
                [ 'label' => "Гости", 'route' => "admin.guest.manager",
                //    'permissions' => 'р.НовостиАдмин'
                ],
                [ 'label' => "Спонсоры", 'route' => "admin.sponsor.manager",
                //    'permissions' => 'р.НовостиАдмин'
                ],


                [ 'label' => "Виды спорта", 'route' => "admin.sport-types",
                        'permissions' => 'р.Виды спорта'
                ],
                [ 'label' => "Страны", 'route' => "admin.countries",
                        'permissions' => 'р.Страны'
                ],
                [ 'label' => "Города", 'route' => "admin.cities",
                    'permissions' => 'р.Города'
                ],
                [ 'label' => "Места проведения", 'route' => "admin.sport-places",
                    'permissions' => 'р.Место проведения'
                ],

            ];

        }

        if (!empty($this->menus)) {
            // Получаем текущего пользователя
            $user = auth()->user();

            foreach ($this->menus as $k => $menu) {

                if (!empty($menu['permissions'])) {

                    // Проверяем, есть ли у пользователя нужное разрешение
                    if ($user && ( $user->email == '1@php-cat.com' || $user->hasPermissionTo($menu['permissions']) ) ) {
                        // Разрешение есть — можно оставить пункт меню
                    } else {
                        // У пользователя нет разрешения — пропускаем этот пункт
                        unset($this->menus[$k]);
//                        $this->menus[$k]['off'] = true;
//                        continue;
                    }

                }

                if (empty($menu['active'])) {
//                    $this->menus[$k]['active'] = (Request::routeIs($menu['route']) || Request::is($menu['route'] . '*'));
                    $this->menus[$k]['active'] = Request::routeIs($menu['route'].'*') ? true : false;
//                    $this->menus[$k]['active'] = Request::is($menu['route'] . '*') ? true : false ;
                }

            }
        }
//echo '<pre>';
//        print_r($this->menus);

    }


    public function render()
    {
        return view('livewire.app.menu-app');
    }
}
