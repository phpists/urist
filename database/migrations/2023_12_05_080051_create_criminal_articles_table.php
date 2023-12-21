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
        Schema::create('criminal_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_category_id')->nullable();
            $table->string('name', 255);
            $table->text('content');
            $table->text('description');
            $table->string('court_decision_link', 512);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminal_articles');
    }
};
