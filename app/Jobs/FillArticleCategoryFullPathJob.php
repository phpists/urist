<?php

namespace App\Jobs;

use App\Models\ArticleCategory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FillArticleCategoryFullPathJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly ArticleCategory $category)
    {
    }

    public function handle(): void
    {
        $this->category->update([
            'full_path' => $this->category->getFullPath()
        ]);
    }
}
