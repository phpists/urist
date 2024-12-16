<?php

namespace App\Observers;

use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Cache;

class ArticleCategoryObserver
{

    /**
     * Handle the ArticleCategory "created" event.
     */
    public function creating(ArticleCategory $articleCategory): void
    {
        $articleCategory->full_path = $articleCategory->getFullPath();
    }

    /**
     * Handle the ArticleCategory "updated" event.
     */
    public function updating(ArticleCategory $articleCategory): void
    {
        $articleCategory->full_path = $articleCategory->getFullPath();
    }

    public function updated(ArticleCategory $articleCategory)
    {
        if ($articleCategory->parent_id) {
            $articleCategory->parent->clearChildIdsCache();
        }
    }

}
