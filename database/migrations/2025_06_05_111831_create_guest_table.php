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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();

            $table->string('last_name')->nullable();   // фамилия
            $table->string('first_name')->nullable();  // имя
            $table->string('middle_name')->nullable(); // отчество, может быть пустым

            $table->string('comment')->nullable();

            $table->string('photo')->nullable();        // фото (путь к файлу), может быть пустым
            $table->date('birth_date')->nullable();     // дата рождения, может быть пустой

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
