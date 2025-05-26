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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // название
            $table->date('date'); // дата
            $table->string('short_text')->nullable(); // краткий текст, может быть пустым
            $table->longText('full_text'); // полный текст
            $table->unsignedBigInteger('event_id')->nullable(); // id мероприятия, может быть пустым
            $table->unsignedBigInteger('athlete_id')->nullable(); // id спортсмена, может быть пустым
            $table->softDeletes();
            $table->timestamps();

            // Если есть таблицы events и athletes, можно добавить внешние ключи:
            // $table->foreign('event_id')->references('id')->on('events')->nullOnDelete();
            // $table->foreign('athlete_id')->references('id')->on('athletes')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
