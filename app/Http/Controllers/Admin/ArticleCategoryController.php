<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $exclude_id = $request->get('exclude_id');
        if ($exclude_id !== null) {
            $article_categories = $article_categories->whereNot('id', $exclude_id);
        }
        $article_categories = $article_categories
            ->limit(30)
            ->get();
        return response()->json($article_categories);
    }

    public function getChildren(Request $request) {
        $validatedData = $request->validate([
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

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|int'
        ]);
        if (isset($validatedData['parent_id']) && !ArticleCategory::query()->find($validatedData['parent_id'])) {
            return redirect()->back(422)->withErrors('Invalid parent id');
        }
        $article_category = new ArticleCategory($validatedData);
        if ($article_category->save())
            return redirect()->back()->with('success', 'Category successfully created');
        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function update(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'nullable|int'
        ]);
        if (isset($validatedData['parent_id']) && !ArticleCategory::query()->find($validatedData['parent_id'])) {
            return redirect()->back(422)->withErrors('Invalid parent id');
        }
        $category = ArticleCategory::query()->findOrFail($request->id);
        $category->update($validatedData);
        return redirect()->back()->with('success', 'Category successfully created');
    }

    public function updateParent(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:article_categories,id',
            'parent_id' => 'sometimes|exists:article_categories,id|nullable'
        ]);
        ArticleCategory::query()->find($validatedData['id'])->update($validatedData);
        return response()->json([
            'success' => true
        ]);
    }

    public function delete() {

    }
}
