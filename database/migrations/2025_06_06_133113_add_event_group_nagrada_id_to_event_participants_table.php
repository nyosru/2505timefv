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
        Schema::table('event_participants', function (Blueprint $table) {
            $table->foreignId('event_group_nagrada_id')
                ->nullable()
                ->constrained('event_group_nagradas')  // <-- правильное имя таблицы
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_participants', function (Blueprint $table) {
            $table->dropForeign(['event_group_nagradas_id']);
            $table->dropColumn('event_group_nagrada_id');
        });
    }
};
