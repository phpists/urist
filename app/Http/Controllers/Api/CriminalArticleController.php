<?php

namespace App\Http\Controllers\Api;

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
        $articles = $this->filterService->getArticles();

        return CriminalArticleResource::collection($articles);
    }

    public function show(CriminalArticle $criminalArticle)
    {
        return $criminalArticle;
    }

    public function categories()
    {
        $categories = $this->filterService->getCategories();

        return CriminalArticleCategoryResource::collection($categories);
    }

}
