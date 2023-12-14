<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ArticleCategory::query()->count() === 0) {
            (new ArticleCategory([
                'name' => 'Категорія №1'
            ]))->save();
        }
        ArticleCategory::factory()->count(20)
            ->state(new Sequence(
            fn (Sequence $sequence) => ['parent_id' => ArticleCategory::all()?->random()??null],
        ))->create();
    }
}
