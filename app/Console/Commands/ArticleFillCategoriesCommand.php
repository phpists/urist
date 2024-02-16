<?php

namespace App\Console\Commands;

use App\Models\CriminalArticle;
use App\Models\CriminalArticleCategory;
use Illuminate\Console\Command;

class ArticleFillCategoriesCommand extends Command
{
    protected $signature = 'article:fill-categories';

    protected $description = 'Command description';

    public function handle(): void
    {
        $articles = CriminalArticle::whereNotNull('article_category_id')->get();

        foreach ($articles as $article) {
            $article->criminalArticleCategories()
                ->create(['article_category_id' => $article->article_category_id]);
            $article->update(['article_category_id' => null]);
        }
    }
}
