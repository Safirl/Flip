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
        Schema::create('user_poll', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // user_id peut être nul
            $table->unsignedBigInteger('poll_id'); // poll_id non nul
            $table->boolean('answer'); // Réponse (vrai ou faux)

            // Définir les relations avec les tables users et polls
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // user_id peut être nul
            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade'); // poll_id est obligatoire

            // Créer un index (mais sans contrainte unique)
            $table->index(['user_id', 'poll_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_poll');
    }
};
