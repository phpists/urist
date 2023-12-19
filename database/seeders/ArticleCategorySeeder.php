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
        $last_pos = 1;
        $total_count = ArticleCategory::query()->count();
        if ($total_count === 0) {
            (new ArticleCategory([
                'name' => 'Категорія №1',
                'position' => $last_pos
            ]))->save();
        }
        else {
            $last_pos =  ArticleCategory::query()->max('position');
        }
        ArticleCategory::factory()->count(20)
            ->state(new Sequence(
            fn (Sequence $sequence) => [
                'parent_id' => ArticleCategory::all()?->random()??null,
                'position' => ($last_pos + $sequence->index + 1)],
        ))->create();
    }
}
