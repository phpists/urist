<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategoryStoreRequest;
use App\Http\Requests\ArticleCategoryUpdateRequest;
use App\Http\Requests\BulkDeleteItemsRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArticleCategoryController extends Controller
{
    public function index() {
        $article_categories = ArticleCategory::query()
            ->orderBy('position')
            ->get();

        $tree_categories = ArticleCategory::query()
            ->whereNull('parent_id')
            ->orderBy('position')
            ->with('children')
            ->get();

        return view(
            'admin.article_categories.index',
            compact('article_categories', 'tree_categories')
        );
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
        $last_pos = ArticleCategory::query()->max('position');
        if (gettype($last_pos) !== 'integer') {
            $last_pos = 0;
        }
        $article_category = new ArticleCategory(array_merge(['position' => $last_pos + 1], $request->all()));
        if ($article_category->save())
            return redirect()->back()->with('success', 'Category successfully created');
        return redirect()->back()->with('error', 'Something went wrong');
    }

    private function updateOrderOfRelated(ArticleCategory $articleCategory, $new_position) {
        if ($articleCategory->position < $new_position) {
            ArticleCategory::query()->whereBetween('position', [$articleCategory->position + 1, $new_position])
                ->update(['position' => DB::raw('position - 1')]);
        } else if($articleCategory->position > $new_position) {
            ArticleCategory::query()->whereBetween('position', [$new_position, $articleCategory->position - 1])
                ->update(['position' => DB::raw('position + 1')]);
        }
    }

    public function update(ArticleCategoryUpdateRequest $request) {
        if (isset($request->parent_id) && !ArticleCategory::query()->find($request->parent_id)) {
            return redirect()->back(422)->withErrors('Неапрвильний ідентифікатор батьківської категорії');
        }
        $category = ArticleCategory::query()->findOrFail($request->id);
        $category->update($request->all());
        return redirect()->back()->with('success', 'Категорія успішно оновлена');
    }

    public function updatePosition(Request $request): \Illuminate\Http\JsonResponse
    {
        $positions = $request->post('positions');

        try {
            if (is_array($positions))
                $this->processCategories($positions);

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return response()->json(['error' => 'Не вдалось оновити дані'], 500);
    }

    private function processCategories($categories, $parent = null)
    {
        foreach ($categories as $i => $item) {
            $category = ArticleCategory::find($item['id']);

            if ($category) {
                $category->update([
                    'parent_id' => $parent->id ?? null,
                    'position' => $i
                ]);

                if (isset($item['children']))
                    $this->processCategories($item['children'], $category);
            }
        }
    }

    public function updateParent(Request $request): \Illuminate\Http\JsonResponse
    {
        $category = ArticleCategory::query()->find($request->id);
        if (!$category) {
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
        if (isset($request->position)) {
            try {
                $this->updateOrderOfRelated($category, $request->position);
            } catch (\Error $error) {
                Log::error($error->getMessage());
            }
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

    public function deleteBulk(BulkDeleteItemsRequest $request): \Illuminate\Http\JsonResponse
    {
        $query = ArticleCategory::query()->whereIn('id', $request->item_list);
        try {
            if ($query->delete())
                return response()->json(['success' => 'Записи успішно видалені']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return response()->json(['error' => 'Не вдалось видалити записи'], 500);
    }

    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $category = ArticleCategory::query()->find($request->id);
        if (!$category) {
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
        if ($category->update(['is_active' => (boolean)$request->status])) {
            Log::info(json_encode($category));
            return response()->json([
                'status' => true,
                'test' => (boolean)$request->status
            ]);
        }
        return response()->json(['error' => 'Не вдалось оновити дані'], 500);
    }
}
