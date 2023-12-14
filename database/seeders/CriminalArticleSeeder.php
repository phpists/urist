<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CriminalArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CriminalArticle::factory()->count(40)->state(new Sequence(
            fn (Sequence $sequence) => ['article_category_id' => ArticleCategory::all()->random(), 'name' => 'Стаття №'.($sequence->index + 1)]
        ))->create();
    }
}
