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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('quote');
            $table->string('author');
            $table->longText('context');
            $table->longText('analysis');
        });
        Schema::create('user_poll', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Poll::class)->constrained()->cascadeOnDelete();
            $table->primary(['user_id', 'poll_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
        Schema::dropIfExists('user_poll');
    }
};
