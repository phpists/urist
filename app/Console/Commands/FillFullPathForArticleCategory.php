<?php

namespace App\Console\Commands;

use App\Models\ArticleCategory;
use Illuminate\Console\Command;

class FillFullPathForArticleCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article-category:fill-full-path';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (ArticleCategory::all() as $category) {
            $category->full_path = $category->getFullPath();
            $category->update();
        }
    }
}
