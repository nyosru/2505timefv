<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{

    public static function checkTelegramAuthorization($data)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');

        showMeTelegaMsg();

        if (!isset($data['hash']) || empty($botToken)) {
            return false;
        }

        $check_hash = $data['hash'];
        unset($data['hash']);
        $data_check_arr = [];
        foreach ($data as $key => $value) {
            $data_check_arr[] = $key . '=' . $value;
        }
        sort($data_check_arr);
        $data_check_string = implode("\n", $data_check_arr);
        $secret_key = hash('sha256', $botToken, true);
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);


        Msg::sendTelegramm('проверка телеги'
            . PHP_EOL . $botToken
            . PHP_EOL . $hash
            . PHP_EOL . $check_hash

            , null, 1);

        if (strcmp($hash, $check_hash) !== 0) {
            throw new Exception('Data is NOT from Telegram');
        }
        if ((time() - $data['auth_date']) > 86400) {
            throw new Exception('Data is outdated');
        }
        return $data;
    }

    public static function verifyTelegramAuth(array $data): bool
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');

        if (!isset($data['hash']) || empty($botToken)) {
            return false;
        }

        $hash = $data['hash'];
        unset($data['hash']); // Убираем хеш перед вычислением

        sort($data); // Сортируем ключи по алфавиту
        $dataCheckString = [];
        foreach ($data as $key => $value) {
            $dataCheckString[] = $key . '=' . $value;
//            $dataCheckString[] = "{$key}={$value}";
        }
        $dataCheckString = implode("\n", $dataCheckString); // Объединяем строки

        // 🔑 Формируем секретный ключ
        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);

        // 🔐 Вычисляем ожидаемый hash
        $expectedHash = hash_hmac('sha256', $dataCheckString, $secretKey);


        Msg::sendTelegramm('проверка телеги'
            . PHP_EOL . $botToken
            . PHP_EOL . $hash
            . PHP_EOL . $expectedHash

            . PHP_EOL . '📌 auth_date: '
            . PHP_EOL . 'received: ' . ($data['auth_date'] ?? '❌ Нет auth_date')
            . PHP_EOL . 'current_time: ' . time()
            . PHP_EOL . 'time_diff: ' . (isset($data['auth_date']) ? time() - $data['auth_date'] : '❌')

            , null, 1);

        return hash_equals($expectedHash, $hash);
    }


}
