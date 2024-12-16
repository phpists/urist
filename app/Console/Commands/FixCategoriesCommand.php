<?php

namespace App\Console\Commands;

use App\Models\ArticleCategory;
use Illuminate\Console\Command;

class FixCategoriesCommand extends Command
{
    protected $signature = 'fix:categories';

    protected $description = 'Command description';

    public function handle(): void
    {
        $this->fixKk();
        $this->fixKpk();
    }

    private function fixKk()
    {
        $kkQuery = ArticleCategory::whereType('kk')->where('full_path', 'like', 'КПК > %');

        $chunkProgressBar = $this->output->createProgressBar($kkQuery->count());
        $chunkProgressBar->setFormat("%message% %current%/%max% [%bar%] %percent:3s%%");
        $chunkProgressBar->setMessage('Фіксимо КК:');
        $chunkProgressBar->start();

        $kkQuery->cursor()->each(function (ArticleCategory $category) use ($chunkProgressBar) {
            $category->update(['type' => 'kpk']);

            $chunkProgressBar->advance();
        });

        $chunkProgressBar->finish();
        echo PHP_EOL;
    }

    private function fixKpk()
    {
        $kpkQuery = ArticleCategory::whereType('kpk')->where('full_path', 'like', 'КК > %');

        $chunkProgressBar = $this->output->createProgressBar($kpkQuery->count());
        $chunkProgressBar->setFormat("%message% %current%/%max% [%bar%] %percent:3s%%");
        $chunkProgressBar->setMessage('Фіксимо КПК:');
        $chunkProgressBar->start();

        $kpkQuery->cursor()->each(function (ArticleCategory $category) use ($chunkProgressBar) {
            $category->update(['type' => 'kk']);

            $chunkProgressBar->advance();
        });

        $chunkProgressBar->finish();
        echo PHP_EOL;
    }
}
