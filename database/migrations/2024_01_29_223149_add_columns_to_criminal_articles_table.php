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
        Schema::table('criminal_articles', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->longText('nazva_pp');
            $table->longText('pp');
            $table->longText('statya_kk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('criminal_articles', function (Blueprint $table) {
            $table->text('content');
            $table->dropColumn(['nazva_pp', 'pp', 'statya_kk']);
        });
    }
};
