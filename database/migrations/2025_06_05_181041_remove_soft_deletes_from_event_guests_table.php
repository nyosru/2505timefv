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
        Schema::table('event_guests', function (Blueprint $table) {
            // Удаляем колонку deleted_at, отвечающую за soft deletes
            $table->dropSoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_guests', function (Blueprint $table) {
            // Восстанавливаем колонку deleted_at для soft deletes
            $table->softDeletes();
        });
    }
};
