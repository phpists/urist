<?php

namespace App\Http\Controllers\Api;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CriminalArticleCategoryResource;
use App\Http\Resources\Api\CriminalArticleResource;
use App\Models\CriminalArticle;
use App\Services\ArticleFilterService;
use Illuminate\Http\Request;

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

    public function show(CriminalArticle $criminalArticle)
    {
        can_user(PermissionEnum::LEGAL_BASE->value);

        return $criminalArticle;
    }

    public function categories()
    {
        $categories = $this->filterService->getCategories();

        return CriminalArticleCategoryResource::collection($categories);
    }

}
