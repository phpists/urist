<?php

namespace App\Listeners;

use App\Events\ArticleCategoryDeleted;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProcessPostCategoryDelete
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ArticleCategoryDeleted $event): void
    {
        ArticleCategory::query()->where('parent_id', $event->article_category->id)->update([
            'parent_id' => $event->article_category->parent_id
        ]);
        if ($event->article_category->parent_id !== null) {
            CriminalArticle::query()
                ->where('article_category_id', $event->article_category->id)
                ->update([
                    'article_category_id' => $event->article_category->parent_id
                ]);
            Log::info('Articles with article_category_id '.$event->article_category.' updated');

        }
        else {
            CriminalArticle::query()
                ->where('article_category_id', $event->article_category->id)
                ->delete();
            Log::info('Articles with article_category_id '.$event->article_category.' deleted');
        }
    }
}
