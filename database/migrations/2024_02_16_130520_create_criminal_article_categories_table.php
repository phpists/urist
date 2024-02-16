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
        Schema::create('criminal_article_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CriminalArticle::class);
            $table->foreignIdFor(\App\Models\ArticleCategory::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminal_article_categories');
    }
};
