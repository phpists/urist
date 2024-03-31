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
        Schema::create('subscription_sessions', function (Blueprint $table) {
            $table->id();
            $table->enum('period', ['month', 'year']);
            $table->string('hash')->unique();
            $table->foreignIdFor(\App\Models\Plan\Plan::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_sessions');
    }
};
