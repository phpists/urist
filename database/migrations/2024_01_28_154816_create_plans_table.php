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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Role::class);
            $table->boolean('is_active')->default(1);
            $table->integer('pos')->default(999);
            $table->string('title');
            $table->integer('price_monthly')->nullable();
            $table->integer('price_semiannual')->nullable();
            $table->integer('price_annual')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
