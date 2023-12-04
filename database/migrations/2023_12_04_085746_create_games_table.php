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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('score')->nullable();
            $table->integer('points')->default(0);
            $table->string('win');
            $table->boolean('is_active')->default(false);
            $table->foreignId('team_id')->index()->constrained('teams');
            $table->foreignId('opponent_id')->index()->constrained('teams');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
