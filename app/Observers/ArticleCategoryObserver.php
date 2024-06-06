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
        $articleCategory->update([
            'full_path' => $articleCategory->getFullPath()
        ]);
    }

    /**
     * Handle the ArticleCategory "updated" event.
     */
    public function updated(ArticleCategory $articleCategory): void
    {
        $articleCategory->update([
            'full_path' => $articleCategory->getFullPath()
        ]);
    }

}
