<?php

namespace App\Observers;

use App\Models\ArticleCategory;

class ArticleCategoryObserver
{

    /**
     * Handle the ArticleCategory "created" event.
     */
    public function created(ArticleCategory $articleCategory): void
    {
        $articleCategory->full_path = $articleCategory->getFullPath();
        $articleCategory->update();
    }

    /**
     * Handle the ArticleCategory "updated" event.
     */
    public function updated(ArticleCategory $articleCategory): void
    {
        $articleCategory->full_path = $articleCategory->getFullPath();
        $articleCategory->update();
    }

}
