<?php

namespace App\Http\Controllers\Api;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CriminalArticleCategoryResource;
use App\Http\Resources\Api\CriminalArticleResource;
use App\Models\CriminalArticle;
use App\Services\ArticleFilterService;
use App\Services\ExportDocument;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;

class CriminalArticleController extends Controller
{

    private ArticleFilterService $filterService;

    public function __construct()
    {
        $this->filterService = new ArticleFilterService(request()->route('type'));
    }

    public function index()
    {
        if ($this->filterService->getType() == 'kk')
            can_user(PermissionEnum::MODULE_KK->value);
        elseif ($this->filterService->getType() == 'kpk')
            can_user(PermissionEnum::MODULE_KPK->value);

        $articles = $this->filterService->getArticles();

        return CriminalArticleResource::collection($articles);
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $items = [];

        if ($q)
            $items = CriminalArticle::select(['id', 'article_category_id', 'name', 'type', 'date'])
                ->where('name', 'like', "%{$q}%")
                ->orderBy('date', 'DESC')
                ->limit(50)
                ->get();

        return \Response::json(['data' => $items]);
    }

    public function show(CriminalArticle $criminalArticle)
    {
        can_user(PermissionEnum::LEGAL_BASE->value);

        return $criminalArticle;
    }

    public function categories()
    {
        $categories = $this->filterService->getCategories()->first()->children;

        return CriminalArticleCategoryResource::collection($categories);
    }

    public function exportDoc(Request $request, CriminalArticle $article)
    {
        can_user(PermissionEnum::EXPORT_PAGE->value);
        ExportDocument::download($article);
    }

}
