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
        Schema::table('news', function (Blueprint $table) {
            // Добавляем поле user_autor_id с внешним ключом на users.id
            $table->foreignId('user_autor_id')
                ->nullable() // если автор может быть не указан, иначе уберите nullable()
                ->constrained('users') // указывает на таблицу users
                ->onDelete('set null') // при удалении пользователя ставим null
//                ->after('id')
            ; // или после нужного столбца
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['user_autor_id']);
            $table->dropColumn('user_autor_id');
        });
    }
};
