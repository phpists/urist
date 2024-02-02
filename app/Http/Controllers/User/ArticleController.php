<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use App\Services\ArticleFilterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {
        $filterService = new ArticleFilterService();

        if (request()->wantsJson()) {
            return new JsonResponse([
                'html' => view('user.articles._items', [
                    'categories' => $filterService->getCategories(),
                    'articles' => $filterService->getArticles()
                ])->render(),
                'url' => request()->fullUrl()
            ]);
        }

        return view('user.articles.index', [
            'categories' => $filterService->getCategories(),
            'articles' => $filterService->getArticles()
        ]);
    }

    public function articlesCount()
    {
        return new JsonResponse([
            'count' => (new ArticleFilterService())->getTotalCount()
        ]);
    }

    public function show(CriminalArticle $article)
    {
        return view('user.articles.show', compact('article'));
    }

    public function search(Request $request)
    {
        $articles = CriminalArticle::search($request->get('search'))->limit(10)->get();

        if ($request->wantsJson()) {
            return new JsonResponse([
                'html' => view('user.articles._search', compact('articles'))->render(),
                'total_count' => $articles->count()
            ]);
        }

        return back();
    }

}
