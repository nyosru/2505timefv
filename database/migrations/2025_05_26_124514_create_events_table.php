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
        Schema::create('events', function (Blueprint $table) {
            $table->id(); $table->string('title');
            $table->date('event_date');
            $table->string('country');
            $table->string('city');
            $table->string('venue');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Добавляем поле deleted_at для soft delete

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
