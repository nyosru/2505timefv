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
        Schema::create('column_role', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('column_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('column_id')->references('id')->on('leed_columns')
//                ->onDelete('cascade')
            ;
            $table->foreign('role_id')->references('id')->on('roles')
//                ->onDelete('cascade')
            ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('column_role');
    }
};
