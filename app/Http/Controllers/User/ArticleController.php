<?php

namespace App\Http\Controllers\User;

use App\Enums\PermissionEnum;
use App\Enums\SystemPageEnum;
use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use App\Services\ArticleFilterService;
use App\Services\ExportDocument;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;

class ArticleController extends Controller
{

    public function index(Request $request, ?string $type = null)
    {
        if ($type == 'kk')
            PermissionService::authorize(PermissionEnum::MODULE_KK->value);
        elseif ($type == 'kpk')
            PermissionService::authorize(PermissionEnum::MODULE_KPK->value);

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
            'articles' => $filterService->getArticles(),
            'systemPage' => SystemPageEnum::ARTICLES->getPage()
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

    public function articlesCount(?string $type = null)
    {
        return new JsonResponse([
            'count' => (new ArticleFilterService($type))->getTotalCount()
        ]);
    }

    public function show(CriminalArticle $article)
    {
        can_user(PermissionEnum::LEGAL_BASE->value);
        return view('user.articles.show', compact('article'));
    }

    public function exportDoc(Request $request, CriminalArticle $article)
    {
        can_user(PermissionEnum::EXPORT_PAGE->value);
        ExportDocument::download($article);
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
            $items = CriminalArticle::select(['id', 'article_category_id', 'name', 'type', 'date'])
                ->where('name', 'like', "%{$search}%")
                ->orderBy('date', 'DESC')
                ->limit(50)
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
