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

    public function index(Request $request, string $type)
    {
        $filterService = new ArticleFilterService($type);

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

    public function search(Request $request)
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

    public function articlesCount(string $type)
    {
        return new JsonResponse([
            'count' => (new ArticleFilterService($type))->getTotalCount()
        ]);
    }

    public function show(CriminalArticle $article)
    {
        return view('user.articles.show', compact('article'));
    }

//    public function search(Request $request)
//    {
//        $articles = CriminalArticle::search($request->get('search'))->limit(10)->get();
//
//        if ($request->wantsJson()) {
//            return new JsonResponse([
//                'html' => view('user.articles._search', compact('articles'))->render(),
//                'total_count' => $articles->count()
//            ]);
//        }
//
//        return back();
//    }

    public function searchItems(Request $request)
    {
        $search = $request->input('search');
        $items = [];

        if ($search)
            $items = CriminalArticle::where('name', 'LIKE', "%{$search}%")
                ->get();

        return view('user.articles.__search-items', [
            'items' => $items
        ])->render();
    }


    public function getFilter(Request $request)
    {
        return view('user.articles.filter.__accordion-items', [
            'filterService' => new \App\Services\ArticleFilterService($request->route('type'))
        ])->render();
    }

}
