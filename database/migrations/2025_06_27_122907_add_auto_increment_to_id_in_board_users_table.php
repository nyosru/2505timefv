<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('board_users', function (Blueprint $table) {

            // Проверяем, существует ли уже первичный ключ на поле id
            $primaryKeyExists = DB::select("SHOW KEYS FROM `board_users` WHERE Key_name = 'PRIMARY'");

            if (empty($primaryKeyExists)) {
            // В MySQL для добавления AUTO_INCREMENT нужно, чтобы поле было PRIMARY KEY
            // Если поле id не является ключом, то сначала сделаем его PRIMARY KEY
            // Затем добавим AUTO_INCREMENT

            // Проверяем, есть ли PRIMARY KEY, если нет — добавим
            // Для простоты используем сырой SQL

            DB::statement('ALTER TABLE `board_users` MODIFY COLUMN `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
            } else {
                // Ключ уже существует, пропускаем изменение
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('board_users', function (Blueprint $table) {
            // Откат: убрать автоинкремент и первичный ключ (если нужно)
            // Здесь нужно быть аккуратным, т.к. может быть другой PK

            DB::statement('ALTER TABLE `board_users` MODIFY COLUMN `id` BIGINT UNSIGNED NOT NULL');
        });
    }
};
