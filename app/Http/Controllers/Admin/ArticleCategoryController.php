<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategoryStoreRequest;
use App\Http\Requests\ArticleCategoryUpdateRequest;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleCategoryController extends Controller
{
    public function index() {
        $article_categories = ArticleCategory::query()->get();
        $tree_categories = ArticleCategory::query()->whereNull('parent_id')->with('children')->get();
        return view('admin.article_categories.index', compact('article_categories', 'tree_categories'));
    }

    public function search(Request $request) {
        $article_categories = ArticleCategory::query()
            ->where('name', 'LIKE', "%".$request->get('search_string')."%");
        $article_category_id = $request->get('article_category_id');
        if ($article_category_id !== null) {
            $article = ArticleCategory::query()->find($article_category_id);
            if ($article) {
                $children_ids = $article->children->pluck('id')->toArray();
                $article_categories = $article_categories->whereNotIn('id', $children_ids);
            }
        }
        $article_categories = $article_categories
            ->limit(30)
            ->get();
        return response()->json($article_categories);
    }

    public function getChildren(Request $request) {
        $request->validate([
            'id_list' => 'required|array'
        ]);
        $categories = ArticleCategory::query()->whereIn('parent_id', $request->id_list)->get();
        return response()->json($categories);
    }

    public function view(Request $request) {
        $article_category = ArticleCategory::query()->find($request->id);
        if (!$article_category) {
            return response()->json([
                'Error' => 'Article category with such id not found'
            ], 404);
        }
        $parent_category = null;
        if ($article_category->parent_id !== null) {
            $parent_category = ArticleCategory::query()->find($article_category->parent_id);
        }
        return response()->json(array_merge($article_category->toArray(), ['parent_category' => $parent_category]));
    }

    public function store(ArticleCategoryStoreRequest $request) {

        if (isset($request->parent_id) && !ArticleCategory::query()->find($request->parent_id)) {
            return redirect()->back(422)->withErrors('Invalid parent id');
        }
        $article_category = new ArticleCategory($request->all());
        if ($article_category->save())
            return redirect()->back()->with('success', 'Category successfully created');
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function update(ArticleCategoryUpdateRequest $request) {
        if (isset($request->parent_id) && !ArticleCategory::query()->find($request->parent_id)) {
            return redirect()->back(422)->withErrors('Неапрвильний ідентифікатор батьківської категорії');
        }
        $category = ArticleCategory::query()->findOrFail($request->id);
        $category->update($request->all());
        return redirect()->back()->with('success', 'Категорія успішно оновлена');
    }

    public function updateParent(Request $request): \Illuminate\Http\JsonResponse
    {
        $category = ArticleCategory::query()->find($request->id);
        if (!$category) {
            return response()->json([
                'message' => 'Не вдалосб знайти категорію'
            ], 404);
        }
        if (!$category->update($request->all())) {
            return response()->json([
                'success' => false,
                'message' => 'Не вдалось оновити дані'
            ], 500);
        }
        return response()->json([
            'success' => true
        ]);
    }

    public function delete(Request $request) {
        $category = ArticleCategory::query()->findOrFail($request->id);
        $category->delete();
        return redirect()->back()->with('success', 'Категорію успішно видалено');
    }
}
