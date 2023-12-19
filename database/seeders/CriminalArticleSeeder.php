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
        $last_pos = CriminalArticle::query()->max('position');
        if (!$last_pos) {
            $last_pos = 0;
        }
        CriminalArticle::factory()->count(40)->state(new Sequence(
            fn (Sequence $sequence) => [
                'article_category_id' => ArticleCategory::all()->random(),
                'name' => 'Стаття №'.($sequence->index + 1),
                'position' => ($last_pos + $sequence->index + 1)
            ]
        ))->create();
    }
}
