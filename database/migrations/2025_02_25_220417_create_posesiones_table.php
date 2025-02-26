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
        Schema::create('posesiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('videojuego_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->unique(['videojuego_id', 'user_id']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posesiones');
    }
};
