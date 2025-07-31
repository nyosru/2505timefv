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
        Schema::table('organizers', function (Blueprint $table) {
            // Связь с городом (city_id)
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();

            // Добавляем новые поля
            $table->string('address')->nullable();
            $table->string('logo')->nullable(); // путь к файлу-логотипу
            $table->string('website')->nullable(); // адрес сайта
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizers', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn(['city_id', 'address', 'logo', 'website']);
        });
    }
};
