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
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('pos')->default(999);
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('blog_tag_relation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Blog::class);
            $table->foreignIdFor(\App\Models\BlogTag::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blog_tag_relation');
    }
};
