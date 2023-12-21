<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use App\Models\CriminalArticle;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $last_pos = Tag::query()->max('position');
        if (!$last_pos) {
            $last_pos = 0;
        }
        $tags = Tag::factory()->count(30)->state(new Sequence(fn (Sequence $sequence) => [
            'position' => ($last_pos + $sequence->index + 1)
        ]))->create();
        ArticleTag::factory()->count(50)->state(new Sequence(fn (Sequence $sequence) => [
            'criminal_article_id' => ArticleCategory::all()->random(),
            'tag_id' => $tags->random()
        ]))->create();
    }
}
