<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\InvitationController;
use App\Livewire\Athlete\Admin as A_Admin;
use App\Livewire\Athlete\AdminForm as A_AdminForm;
use App\Livewire\Athlete\Listing as A_Listing;
use App\Livewire\Athlete\Show as A_Show;
use App\Livewire\Cms2\Client;
use App\Livewire\Cms2\Order;
use App\Livewire\CountryCrud;
use App\Livewire\Event\Admin;
use App\Livewire\Event\Listing;
use App\Livewire\Event\Show;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;


Route::get('/a/{id}', function ($id) {

    try {
        // Находим пользователя по ID
        $user = User::findOrFail($id);
        // Входим в систему как этот пользователь
        Auth::login($user);
        \App\Http\Controllers\UserController::checkRolesAndSetRoleOne();
    } catch (Exception $e) {
        Auth::logout();
    }

    // Перенаправляем на домашнюю страницу или на страницу профиля
    return redirect('/')//->with('success', 'Вы вошли как ' . $user->name)
        ;
});


Route::prefix('go-to-test')->name('go-to-test.')->group(function () {

    Route::get('', function () {
        $user = User::findOrFail(2);
        Auth::login($user);
        // Перенаправляем на домашнюю страницу или на страницу профиля
        return redirect('/leed')
            ->with('success', 'Вы вошли как ' . $user->name);
    })->name('sz');

});


// Маршрут для перенаправления на страницу авторизации Telegram
Route::get('/auth/telegram', function () {
    // Если вы используете сторонний пакет, замените 'telegram' на нужный вам драйвер
    return Socialite::driver('telegram')->redirect();
});

// Маршрут для обработки обратного вызова от Telegram
Route::get('/auth/telegram/callback', function () {

    // Если вы используете сторонний пакет, замените 'telegram' на нужный вам драйвер
    $data = Socialite::driver('telegram')->user();
    // Логика для создания или обновления пользователя в вашей базе данных
    // Делаем проверку (можно добавить проверку подписи Telegram)

    if ($data['id'] == 360209578) {
        $email = '1@php-cat.com';
    } else {
        $email = $data['id'] . '@telegram.ru';
    }

    try {

//        $user = \App\Models\User::whereEmail($data['id'] . '@telegram.ru')->firstOrFail();
        $user = \App\Models\User::whereTelegramId($data['id'])->firstOrFail();

    } catch (\Exception $e) {

        $user = \App\Models\User::updateOrCreate(
            [
                'telegram_id' => $data['id']
            ],
            [
                'email' => $email,
                'password' => bcrypt($data['id']),
                'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
                'username' => $data['username'] ?? null,
                'avatar' => $data['photo_url'] ?? null,
            ]
        );
    }

//    showMeTelegaMsg( 'user: '. serialize($user->toArray()) );
// Авторизуем пользователя
    Auth::login($user);
    \App\Http\Controllers\UserController::checkRolesAndSetRoleOne();


    // Перенаправление на нужную страницу после авторизации
    return redirect('/');
//    return redirect()->route('leed.list');
});


//use App\Http\Controllers\Service\TrixUploadController;
//Route::post('/trix-upload', [TrixUploadController::class, 'upload'])->name('trix.upload');


Route::get('', \App\Livewire\Index::class)->name('index');


Route::get('news', \App\Livewire\News\Listing::class)->name('news');
Route::get('news/{id}', \App\Livewire\News\Item::class)->name('news.show');

//Route::get('/news', Listing::class)->name('news.index');
//Route::get('/news/{id}', Item::class)->name('news.show');


Route::middleware(['auth'])->group(function () {
    Route::group(['as' => 'admin', 'prefix' => 'admin'], function () {

        Route::get('news', \App\Livewire\News\Admin::class)
            ->name('.news')//    ->middleware(['auth'])
        ; // Добавьте защиту по необходимости

        Route::get('news/create', \App\Livewire\News\AdminForm::class)
            ->name('.news.create')//    ->middleware(['auth'])
        ; // Добавьте защиту по необходимости

        Route::get('news/{news}/edit', \App\Livewire\News\AdminForm::class)
            ->name('.news.edit');
//
//        Route::get('events', \App\Livewire\News\AdminForm::class)
//            ->name('.events')//    ->middleware(['auth'])
//        ; // Добавьте защиту по необходимости

    });
});


Route::get('/events', Listing::class)->name('events.index');
Route::get('/events/{id}', Show::class)->name('events.show');

Route::get('/athletes', A_Listing::class)->name('athletes.index');
Route::get('/athletes/{id}', A_Show::class)->name('athletes.show');


Route::middleware(['auth'])->group(function () {
    Route::group(['as' => 'admin', 'prefix' => 'admin'], function () {

        Route::get('events', Admin::class)
            ->name('.events')//    ->middleware('auth')
        ; // при необходимости
        Route::get('events/form/{id?}', \App\Livewire\Event\AdminForm::class)
            ->name('.events.form')//    ->middleware('auth')
        ; // при необходимости



        Route::get('athletes', A_Admin::class)
            ->name('.athletes')//    ->middleware('auth')
        ; // при необходимости

        Route::get('athletes/form/{id?}', A_AdminForm::class)
            ->name('.athletes.form')//    ->middleware('auth')
        ; // при необходимости


        Route::middleware('check.permission:р.Виды спорта')->group(function () {
            Route::get('sport-types', \App\Livewire\SportTypeCrud::class)
                ->name('.sport-types')//    ->middleware('auth')
            ; // если нужна авторизация
        });

        Route::middleware('check.permission:р.Гости')->group(function () {
            Route::get('guest/manager', \App\Livewire\Event\GuestManagerComponent::class)
                ->name('.guest.manager')//    ->middleware('auth')
            ; // если нужна авторизация
        });

        Route::middleware('check.permission:р.Спонсоры')->group(function () {
            Route::get('sponsor/manager', \App\Livewire\EventAdm\SponsorManagerComponent::class)
                ->name('.sponsor.manager')//    ->middleware('auth')
            ; // если нужна авторизация
        });


        Route::middleware('check.permission:р.Страны')->group(function () {
            Route::get('countries', CountryCrud::class)
                ->name('.countries')//    ->middleware('auth')
            ; // если нужна авторизация
        });

        Route::middleware('check.permission:р.Города')->group(function () {
            Route::get('cities', \App\Livewire\DataIn\CityCrudComponent::class)
                ->name('.cities')//    ->middleware('auth')
            ; // если нужна авторизация
        });

        Route::middleware('check.permission:р.Место проведения')->group(function () {
            Route::get('sport-places', \App\Livewire\DataIn\SportPlaceCrud::class)
                ->name('.sport-places')//    ->middleware('auth')
            ; // если нужна авторизация
        });

        Route::get('event-participants', App\Livewire\Event\EventParticipantCrud::class)
            ->name('.event-participants')//    ->middleware('auth')
        ; // если нужна авторизация

    });
});


// Маршрут для авторизованного пользователя
Route::middleware(['auth'])->group(function () {

//Route::middleware('check.permission:р.Техничка')->group(function () {
    Route::prefix('tech')->name('tech.')->
    middleware('check.permission:р.Техничка')->
    group(function () {

        Route::get('', \App\Livewire\Cms2\Tech\Index::class)->name('index');

        Route::get('/roles', \App\Livewire\RolePermissions::class)
            ->name('role_permission');


        // пользователи
//        Route::middleware('check.permission:р.Пользователи')->group(function () {
        Route::get('/u-list', \App\Livewire\Cms2\UserList::class)->name('user_list');
//        });


    });

    Route::group(['as' => 'board', 'prefix' => 'board'], function () {
        Route::get('', \App\Livewire\Board\BoardComponent::class)
            ->name('')
            ->middleware('check.permission:р.Доски');
        Route::get('select', \App\Livewire\Cms2\Leed\SelectBoardForm::class)->name('.select');
//        Route::post('invitations', [InvitationController::class, 'store'])->name('.invitations.store');
        Route::get('invitations/join/{id}', [InvitationController::class, 'join'])->name('.invitations.join');
    });

    Route::group(['as' => 'lk.'], function () {
        Route::get('profile', \App\Livewire\Lk\Profile::class)->name('profile');
    });

    Route::get('leed', \App\Livewire\Cms2\Leed\LeedBoardList::class)->name('leed.list');
//  чел переходит в доску, проверяем и назначаем права и переадресовываем на доску
    Route::get('leed/goto/{board_id}/{role_id}', [\App\Http\Controllers\BoardController::class, 'goto'])->name('leed.goto');
    Route::get('leed/{board_id}', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leed');
    Route::get('leed/{board}/config', \App\Livewire\Board\ConfigComponent::class)->name('board.config');

//});
});








if (1 == 2) {

    //Route::get('/auth/telegram-in/callback', [TelegramController::class, 'callbackOrigin']);
//Route::get('/auth/telegram/callback', [TelegramController::class, 'callbackStart']);
//Route::post('/auth/telegram/callback777', [TelegramController::class, 'callback']);


    Route::get('/download/{id}/{file_name}', [DownloadController::class, 'download'])->name('download.file');


// Маршрут для НЕ авторизованного пользователя
    Route::middleware(['guest'])->group(function () {

//    Route::get('', \App\Livewire\Index::class)->name('login');

//// Авторизуем пользователя

//    Route::fallback(function () {
//        return redirect('/');
//    });
    });


// Маршрут для авторизованного пользователя
    Route::middleware(['auth'])->group(function () {

//    Route::get('', \App\Livewire\Cms2\Leed\LeedBoardList::class)->name('index');


        Route::get('', function () {
            return redirect(route('leed.list'));
        })->name('index');
////    Route::get('', \App\Livewire\Index::class)->name('login');


        Route::get('index', \App\Livewire\Board\BoardIndexComponent::class)->name('board.index');


        Route::get('logout', function () {
            Auth::guard('web')->logout();
            Session::invalidate();
            Session::regenerateToken();
        });


        Route::group(['as' => 'lk.'], function () {
            Route::get('profile', \App\Livewire\Lk\Profile::class)->name('profile');
        });


//Route::middleware('check.permission:р.Лиды')->group(function () {

        Route::get('leed', \App\Livewire\Cms2\Leed\LeedBoardList::class)->name('leed.list');

        //  чел переходит в доску, проверяем и назначаем права и переадресовываем на доску
        Route::get('leed/goto/{board_id}/{role_id}', [\App\Http\Controllers\BoardController::class, 'goto'])->name('leed.goto');

        Route::get('leed/{board_id}', \App\Livewire\Cms2\Leed\LeedBoard::class)->name('leed');
        Route::get('leed/{board}/config', \App\Livewire\Board\ConfigComponent::class)->name('board.config');


        Route::get('leed/{board}/delete', [\App\Http\Controllers\BoardController::class, 'delete'])
            ->name('board.config.delete')
            ->middleware('check.permission:р.Доски / удалить');

        Route::get('leed/{board_id}/{id}', \App\Livewire\Cms2\Leed\Item::class)->name('leed.item');

//        Route::get('/leed/{id}', \App\Livewire\Cms2\ClientsInfo::class)->name('clients.info');
//});

        Route::group(['as' => 'board', 'prefix' => 'board'], function () {
            Route::get('', \App\Livewire\Board\BoardComponent::class)
                ->name('')
                ->middleware('check.permission:р.Доски');
            Route::get('select', \App\Livewire\Cms2\Leed\SelectBoardForm::class)->name('.select');
//        Route::post('invitations', [InvitationController::class, 'store'])->name('.invitations.store');
            Route::get('invitations/join/{id}', [InvitationController::class, 'join'])->name('.invitations.join');
        });


        Route::get('service/auto', \App\Livewire\Service\AutomationRulesManager::class)->name('service.automation_rules_manager');


        Route::middleware('check.permission:р.Техничка')->group(function () {
            Route::prefix('tech')->name('tech.')->group(function () {

                Route::get('', \App\Livewire\Cms2\Tech\Index::class)->name('index');

                Route::get('inn_searc_org', \App\Livewire\Service\DadataOrgSearchComponent::class)->name('service.dadata_org_search_component');

//                Route::get('/roles', \App\Livewire\RolePermissions::class)
//                    ->name('role_permission');

                Route::middleware('check.permission:тех.Управление столбцами')->group(function () {
                    Route::get('adm_role_column', \App\Livewire\RoleColumnAccess::class)->name('adm_role_column');
                });

                Route::middleware('check.permission:тех.упр полями в лиде')->group(function () {
                    Route::get('order_requests_manager', \App\Livewire\Tech\OrderRequestsManager::class)->name('order_requests_manager');
                });

                Route::get('order-request-rename-form', \App\Livewire\Board\OrderRequestRenameForm::class)->name('order-request-rename-form');

                // пользователи
                Route::middleware('check.permission:р.Пользователи')->group(function () {
                    Route::get('/u-list', \App\Livewire\Cms2\UserList::class)->name('user_list');
                });

                Route::prefix('order')->name('order.')->group(function () {
                    Route::middleware('check.permission:тех.ТипПродуктаУпр')->group(function () {
                        Route::get('prod-type', \App\Livewire\Cms2\Tech\ProductTypeManager::class)->name(
                            'product-type-manager'
                        );
                    });
                    Route::middleware('check.permission:тех.ТипОплатыМен')->group(function () {
                        Route::get('payment-type', \App\Livewire\Cms2\Order\PaymentTypeManager::class)->name(
                            'payment-type-manager'
                        );
                    });
                });

            });
        });


        Route::middleware('check.permission:р.Клиенты')->group(function () {
            Route::prefix('clients')->name('clients')->group(function () {
                Route::get('/', Client\Clients::class);

                Route::get('create', Client\ClientsInfo::class)->name('.create');

                Route::get('{client_id}', Client\ClientsInfo::class)->name('.info');
                Route::get('{client_id}/edit', Client\ClientsInfo::class)->name('.edit');
            });
        });

        Route::group(['as' => 'order', 'prefix' => 'order'], function () {
            Route::get('', Order\ListFull::class)->name('.index');
//    Route::get('show/{order_id}', Order\Item::class)->name('.item');

            Route::get('create', Order\OrderCreate::class)->name('.create');
        });

    });

}

//require __DIR__ . '/auth.php';
//Route::get('login', \App\Livewire\Index::class)->name('login');
//Route::get('', \App\Livewire\Index::class)->name('login');
Route::get('', \App\Livewire\News\Listing::class)->name('login');
