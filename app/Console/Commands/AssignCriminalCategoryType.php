<?php

namespace App\Console\Commands;

use App\Enums\CriminalArticleTypeEnum;
use App\Http\Controllers\User\ArticleController;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use Illuminate\Console\Command;

class AssignCriminalCategoryType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'criminal-categories:assign-type';

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
        $kkCategory = ArticleCategory::whereName('КК')->firstOrFail();
        $kpkCategory = ArticleCategory::whereName('КПК')->firstOrFail();

        $this->assignType($kkCategory, CriminalArticleTypeEnum::KK->value);
        $this->assignArticles($kkCategory, CriminalArticleTypeEnum::KK->value);
        $this->processChilds($kkCategory, CriminalArticleTypeEnum::KK->value);

        $this->assignType($kpkCategory, CriminalArticleTypeEnum::KPK->value);
        $this->assignArticles($kpkCategory, CriminalArticleTypeEnum::KPK->value);
        $this->processChilds($kpkCategory, CriminalArticleTypeEnum::KPK->value);
    }

    private function processChilds(ArticleCategory $category, string $type): void
    {
        foreach ($category->children as $child) {
            $this->assignType($child, $type);
            $this->assignArticles($child, $type);

            if ($child->children)
                $this->processChilds($child, $type);
        }
    }

    private function assignArticles(ArticleCategory $category, string $type): void
    {
        foreach ($category->articles as $article)
            $this->assignType($article, $type);
    }

    private function assignType(ArticleCategory|CriminalArticle $model, string $type): void
    {
        $model->update([
            'type' => $type
        ]);
    }

}
