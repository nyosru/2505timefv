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
        Schema::table('events', function (Blueprint $table) {
            // Добавляем поле sport_place_id
            // Добавляем внешний ключ на sport_places
            $table->unsignedBigInteger('sport_place_id')->nullable();
            $table->foreign('sport_place_id')->references('id')->on('sport_places')->nullOnDelete();

            // Добавляем поле country_id (nullable)
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->nullOnDelete();

            // Добавляем поле city_id (nullable)
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->nullOnDelete();




            // Удаляем поля country, city, venue
            if (Schema::hasColumn('events', 'country')) {
                $table->dropColumn('country');
            }
            if (Schema::hasColumn('events', 'city')) {
                $table->dropColumn('city');
            }
            if (Schema::hasColumn('events', 'venue')) {
                $table->dropColumn('venue');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Восстанавливаем удалённые поля
            $table->string('country')->nullable()->after('sport_place_id');
            $table->string('city')->nullable()->after('country');
            $table->string('venue')->nullable()->after('city');

            // Удаляем внешние ключи и столбцы
            $table->dropForeign(['sport_place_id']);
            $table->dropColumn('sport_place_id');

            $table->dropForeign(['country_id']);
            $table->dropColumn('country_id');

            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
    }
};
