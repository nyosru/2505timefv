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
            // Сначала удаляем внешний ключ
            $table->dropForeign(['sport_type_id']);
            // Затем удаляем индекс (если нужно, обычно dropForeign удаляет индекс)
            // $table->dropIndex(['sport_type_id']); // обычно не требуется
            // После этого удаляем сам столбец
            $table->dropColumn('sport_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('sport_type_id')->nullable();
            $table->foreign('sport_type_id')->references('id')->on('sport_types')->onDelete('set null');
        });
    }
};
