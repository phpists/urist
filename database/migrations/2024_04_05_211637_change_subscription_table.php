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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->enum('period', ['day', 'month', 'year'])->change();
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->enum('period', ['day', 'month', 'year'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->enum('period', ['month', 'year'])->change();
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->enum('period', ['month', 'year'])->change();
        });
    }
};
