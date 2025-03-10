<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategoryUpdateRequest;
use App\Http\Requests\BulkDeleteItemsRequest;
use App\Http\Requests\CriminalArticleStoreRequest;
use App\Http\Requests\CriminalArticleUpdatePositionRequest;
use App\Http\Requests\CriminalArticleUpdateRequest;
use App\Http\Requests\StoreFavouriteRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use App\Models\Favourite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CriminalArticleController extends Controller
{
    public function index(Request $request) {
        $criminal_articles = CriminalArticle::query()
            ->when($date = $request->input('date'), function ($query) use ($date) {
                $query->where('date', $date);
            })
            ->when($date_to = $request->input('date_to'), function ($query) use ($date_to) {
                $query->where('date', '<=', $date_to);
            });

        if ($sort = $request->get('sort')){
            [$column, $direction] = explode(':', $sort);
            if ($column && $direction)
                $criminal_articles->orderBy($column, $direction);
        } else {
            $criminal_articles->orderBy('date', 'DESC');
        }

        if (isset($request->article_category_list) && (gettype($request->article_category_list) === 'array')) {
            $category_ids = $request->article_category_list;
            foreach ($category_ids as $category_id)
                $category_ids = array_merge($category_ids, ArticleCategory::getChildIds($category_id));

            $criminal_articles = $criminal_articles->whereHas('categories', function ($q) use ($category_ids) {
                return $q->whereIn('article_categories.id', $category_ids);
            });
        }
        if (isset($request->name)) {
            $criminal_articles = $criminal_articles->where('name', 'like', '%'.$request->name.'%');
        }

        $criminal_articles = $criminal_articles
            ->with('category');

        $perPage = request('per-page', 100);
        if ($perPage == 'all')
            $criminal_articles = $criminal_articles->get();
        else
            $criminal_articles = $criminal_articles->paginate($perPage);

        if ($request->ajax()) {
            $table = view('admin.criminal_articles.parts.table', compact('criminal_articles'))->render();
            $pagination = view('admin.criminal_articles.parts.paginate', compact('criminal_articles'))->render();
            return response()->json([
                'table' => $table,
                'pagination' => $pagination
            ]);
        }
        return view('admin.criminal_articles.index', compact('criminal_articles'));
    }
    public function create() {
        return view('admin.criminal_articles.create');
    }
    public function store(CriminalArticleStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $last_pos = CriminalArticle::query()->max('position');
        if (gettype($last_pos) !== 'integer') {
            $last_pos = 0;
        }

        $article = new CriminalArticle(array_merge($request->all(), ['position' => $last_pos + 1]));
        if ($article->save()) {
            $article->categories()->sync($request->post('article_categories'), []);

            $article->update([
                'type' => $article->categories->first()->type
            ]);

            $this->insertArticleTags($request, $article);
            return redirect()->back()->with('success', 'Стаття успішно збережена');
        }

        return back()->with('error', 'Не вдалось зберегти дані');
    }
    public function update(CriminalArticleUpdateRequest $request): bool|\Illuminate\Http\RedirectResponse
    {
        $article = CriminalArticle::query()->find($request->id);
        if (!$article) {
            return redirect()->back()->withErrors('Стаття не знайдена');
        }
        $this->insertArticleTags($request, $article);
        $article->categories()->sync($request->post('article_categories', []));
        $article->fill($request->all());
        if ($article->update()) {
            return redirect()->back()->with('success', 'Стаття успішно оновлена');
        }
        return redirect()>back()->withErrors('Не вдалось оновити дані');
    }
    public function delete(string $id) {
        $article = CriminalArticle::query()->find($id);
        if (!$article) {
            return redirect()->back()->withErrors('Стаття не знайдена');
        }
        $article->delete();
        return redirect()->back()->with('success', 'Article deleted correct');
    }

    public function deleteBulk(BulkDeleteItemsRequest $request) {
        $query = CriminalArticle::query()->whereIn('id', $request->item_list);
        try {
            if ($query->delete())
                return response()->json(['success' => 'Записи успішно видалені']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return response()->json(['success' => 'Не вдалось видалити записи'], 500);
    }

    public function edit(string $id) {
        $criminal_article = CriminalArticle::query()->findOrFail($id);
        return view('admin.criminal_articles.edit', compact('criminal_article'));
    }

    public function search(Request $request) {
        $criminal_articles = CriminalArticle::query()
            ->where('name', 'LIKE', '%'.$request->get('search_string').'%')
            ->limit(20)
            ->get();
        return response()->json($criminal_articles);
    }

    public function addToFavourites(StoreFavouriteRequest $request) {
        $article = CriminalArticle::query()->find($request->criminal_article_id);
        if (!$article) {
            return response()->json([
                'error' => 'Article not found'
            ], 404);
        }

        if (Favourite::whereCriminalArticleId($request->post('criminal_article_id'))->whereFolderId($request->validated('folder_id'))->exists()) {
            if ($request->wantsJson())
                return new JsonResponse([
                    'result' => false,
                    'message' => 'Ця стаття вже є у вас в закладках в обраній папці'
                ]);
        }

        $favourite = new Favourite([
            'user_id' => $request->user()->id,
            'folder_id' => $request->folder_id,
            'criminal_article_id' => $request->criminal_article_id,
            'name' => $request->name??$article->name
        ]);

        if ($favourite->save()) {
            $message = "Статтю успішно додано в закладки";

            if ($request->wantsJson())
                return new JsonResponse([
                    'result' => true,
                    'message' => $message
                ]);

            return redirect()->back()->with('success', $message);
        }

        if ($request->wantsJson())
            return new JsonResponse([
                'result' => false,
                'message' => 'Помилка при збереженні, спробуйте пізніше'
            ], 500);

        return redirect()->back()->withErrors('Помилка при збереженні, спробуйте пізніше');
    }

    private function updateOrderOfRelated(CriminalArticle $article, $new_position): void
    {
        if ($article->position < $new_position) {
            CriminalArticle::query()->whereBetween('position', [$article->position + 1, $new_position])
                ->update(['position' => DB::raw('position - 1')]);
        } else if($article->position > $new_position) {
            CriminalArticle::query()->whereBetween('position', [$new_position, $article->position - 1])
                ->update(['position' => DB::raw('position + 1')]);
        }
    }
    public function updatePosition(UpdatePositionRequest $request): \Illuminate\Http\JsonResponse
    {
        $article = CriminalArticle::query()->find($request->id);
        if (!$article) {
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
        try {
            $this->updateOrderOfRelated($article, $request->position);
            $result = $article->update([
                'position' => $request->position
            ]);
            if ($result)
                return response()->json([
                    'sucecss' => true
                ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return response()->json(['error' => 'Не вдалось оновити дані'], 500);
    }
    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $article = CriminalArticle::query()->find($request->id);
        if (!$article) {
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
        if ($article->update(['status' => $request->status])) {
            return response()->json([
                'status' => true
            ]);
        }
        return response()->json(['error' => 'Не вдалось оновити дані'], 500);
    }

    /**
     * @param CriminalArticleStoreRequest|CriminalArticleUpdateRequest $request
     * @param CriminalArticle $article
     * @return void
     */
    private function insertArticleTags(CriminalArticleStoreRequest|CriminalArticleUpdateRequest $request, CriminalArticle $article): void
    {
        if (gettype($request->tag_list) === 'array') {
            $tag_records = [];
            DB::table('article_tags')->where('criminal_article_id', $article->id)->delete();
            foreach ($request->tag_list as $tag_id) {
                if (DB::table('tags')->find($tag_id))
                    $tag_records[] = ['tag_id' => $tag_id, 'criminal_article_id' => $article->id];
            }
            DB::table('article_tags')->insert($tag_records);
        }
    }



    public function checkName(Request $request)
    {
        $article = CriminalArticle::whereName($request->get('name'))->whereNot('id', $request->get('id'))->first();
        if ($article) {
            $url = route('admin.criminal_article.edit', ['id' => $article->id]);
            return [
                'result' => false,
                'message' => "Стаття з такою назвою вже існує, ось посилання на оригінал: <a href='{$url}' target='_blank'>{$url}</a>"
            ];
        }

        return [
            'result' => true
        ];
    }

    public function updateCategory(Request $request, CriminalArticle $article)
    {
        $oldCategory = ArticleCategory::findOrFail($request->post('old_category_id'));
        $category = ArticleCategory::findOrFail($request->post('category_id'));

        DB::beginTransaction();
        try {
            $article->criminalArticleCategories()->whereArticleCategoryId($oldCategory->id)->delete();
            $article->criminalArticleCategories()->create([
                'article_category_id' => $category->id
            ]);
            DB::commit();

            return [
                'result' => true,
                'html' => [
                    $oldCategory->id => view('admin.article_categories.parts.category-articles', ['category' => $oldCategory])->render(),
                    $category->id => view('admin.article_categories.parts.category-articles', ['category' => $category])->render()
                ]
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'result' => false
            ];
        }
    }

    public function showFullName(Request $request, CriminalArticle $article)
    {
        return [
            'name' => 'Стаття',
            'full_path' => $article->name
        ];
    }

    public function deleteCategory(Request $request, CriminalArticle $article)
    {
        $category = ArticleCategory::findOrFail($request->post('category_id'));
        try {
            $article->criminalArticleCategories()->whereArticleCategoryId($category->id)->delete();
            return [
                'result' => true
            ];
        } catch (\Exception $e) {
            return [
                'result' => false
            ];
        }
    }

    public function addCategory(Request $request)
    {
        $article = CriminalArticle::findOrFail($request->post('article_id'));
        $category = ArticleCategory::findOrFail($request->post('category_id'));
        try {
            $article->criminalArticleCategories()->create([
                'article_category_id' => $category->id
            ]);

            return [
                'result' => true,
                'html' => [
                    $category->id => view('admin.article_categories.parts.category-articles', ['category' => $category])->render()
                ]
            ];
        } catch (\Exception $e) {
            return [
                'result' => false
            ];
        }
    }

    public function getAllArticlesForSelect(Request $request)
    {
        $request->validate([
            'search_string' => 'sometimes|string'
        ]);
        $search = $request->get('search_string');
        return response()->json(CriminalArticle::where('name', 'LIKE', "%{$search}%")->get(['id', 'name']));
    }

    public function moveToAnotherCategory(Request $request)
    {
        $article = CriminalArticle::findOrFail($request->post('article_id'));
        $article->categories()->detach($request->post('old_category_id'));
        $article->categories()->attach($request->post('new_category_id'));
    }

}
