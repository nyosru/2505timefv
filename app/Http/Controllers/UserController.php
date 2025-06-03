<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public static function setBoardRole($user_id, $board_id, $role_id): void
    {

// Делаем проверку (можно добавить проверку подписи Telegram)
        $set = \App\Models\BoardUser::updateOrCreate(
            [
                'board_id' => $board_id,
                'user_id' => $user_id,
                'role_id' => $role_id
            ]
//        ,
//            [
//                'email' => $data['id'] . '@telegram.ru',
//                'password' => bcrypt($data['id']),
//                'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
//                'username' => $data['username'] ?? null,
//                'avatar' => $data['photo_url'] ?? null,
//            ]
        );

        self::updateRole($user_id, $role_id);
        self::setCurentBoard($user_id, $board_id);

//        dd($set);

    }

    /**
     * установить роль у пользователя в базе данных (стереть остальные)
     * @param $userId
     * @param $roleId
     * @return void
     */
    public static function updateRole($userId, $roleId)
    {
        $user = User::find($userId);
        self::setNewRole($user, $roleId);

    }

    public static function setNewRole($user, $roleId)
    {

        try {
            // Используем sync для отвязки всех и добавления новой роли
            $user->roles()->sync([$roleId]);
        } catch (\Exception $e) {
        }

    }

    public static function setCurentBoard($userId, $boardId)
    {
        $user = User::find($userId);
        self::setInUSerCurentBoard($user, $boardId);
    }

    public static function setInUSerCurentBoard($user, $boardId)
    {
        $user->current_board_id = $boardId;
        $user->save();
    }

    public static function setPhoneNumberFromTelegaId($user_telega_id, $phone_number): void
    {
        User::where('telegram_id', $user_telega_id)->update(['phone_number' => $phone_number]);
    }


    /**
     * проверяем есть ли одна запись о роли у пользователя и присваиваем эту роль пользователю
     * @return void
     */
    public static function checkRolesAndSetRoleOne()
    {
//        $user = Auth::user();
        $user = Auth::user();
//        dd($user);
//        $user = auth()->user();
//        $user = User::find($user_id);
//            dd([$user,$user->id]);

        $data = User::whereId($user->id)
            ->with([
                'boardUser',
//                'currentBoard',
//                'invitations',
//                'roles',
//                    'role'
            ])->first();

        //dd([$data,$data->boardUser->count()]);

        if ($data->boardUser->count() == 1) {

            self::setInUSerCurentBoard($user, $data->boardUser[0]->board_id);
            self::setNewRole($user, $data->boardUser[0]->role_id);

            //"board_id" => 1
            //"user_id" => 2
            //"role_id" => 2
        }


    }

}
