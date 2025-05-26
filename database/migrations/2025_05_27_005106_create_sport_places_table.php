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
        Schema::create('sport_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id'); // id города
            $table->string('name');                // название
            $table->string('photo')->nullable();  // фото (может быть пустым)
            $table->string('photo_s3_url')->nullable(); // ссылка на фото в s3 (может быть пустой)
            $table->timestamps();
            $table->softDeletes();

            // Внешний ключ на таблицу городов
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_places');
    }
};
