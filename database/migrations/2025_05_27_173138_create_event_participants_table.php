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
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id();
            // Внешний ключ на участника (например, спортсмена)
            $table->unsignedBigInteger('athlete_id');
            $table->foreign('athlete_id')->references('id')->on('athletes')->cascadeOnDelete();

            // Внешний ключ на мероприятие
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->cascadeOnDelete();

            // Флаг победы (true - победитель, false - просто участник)
            $table->unsignedInteger('place')->nullable()->comment('Место в турнире');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_participants');
    }
};
