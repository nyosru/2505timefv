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
        Schema::table('event_attachments', function (Blueprint $table) {
            // Добавляем поле link, строка, может быть null
            $table->string('link')->nullable();

            // Добавляем новое значение 'publication' в enum type
            // В Laravel нет прямой поддержки изменения enum, поэтому используем DB::statement
        });

        // Добавляем новое значение 'publication' в enum type через SQL
        // Для MySQL нужно получить текущие значения enum и добавить новое
        // В данном случае текущие значения: 'image','video','document'
        // Добавим 'publication'

        DB::statement("
            ALTER TABLE `event_attachments` 
            MODIFY `type` ENUM('image','video','document','publication') NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_attachments', function (Blueprint $table) {
            $table->dropColumn('link');
        });

        // Удаляем значение 'publication' из enum (возвращаем к исходному)
        DB::statement("
            ALTER TABLE `event_attachments` 
            MODIFY `type` ENUM('image','video','document') NOT NULL
        ");
    }
};
