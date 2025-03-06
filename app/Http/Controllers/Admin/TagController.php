<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkDeleteItemsRequest;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Requests\ViewTagRequest;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::query()->orderBy('position')->paginate(20);
        return view('admin.tags.index', compact('tags'));
    }

    public function update(UpdateTagRequest $request) {
        $tag = Tag::query()->find($request->id);
        if (!$tag) {
            return redirect()->back()->withErrors('Не вдалось знайти запису з id '.$request->id);
        }
        if ($tag->update($request->all())) {
            return redirect()->back()->with('success', 'Дані успішно оновлені');
        }
        return redirect()->back()->withErrors('Помилка при оновлені даних, спробуйте пізніше');
    }

    public function store(StoreTagRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = [
            'name' => $request->name,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'border_color' => $request->border_color,
        ];
        $position = Tag::query()->max('position');
        if (!isset($position)) {
            $position = 0;
        }
        $data['position'] = $position + 1;
        $tag = new Tag($data);
        if ($tag->save()) {
            return redirect()->back()->with('success', 'Хештег успішно створено');
        }
        return redirect()->back()->withErrors('Помилка при створенні запису, спробуйте ще раз');
    }

    public function view(ViewTagRequest $request) {
        $tag = Tag::query()->find($request->id);
        if (!$tag) {
            return response()->json([
                'message' => 'Couldnt found record with id '.$request->id
            ], 404);
        }
        return response()->json($tag);
    }

    public function search(Request $request) {
        $tags = Tag::query()
            ->where('name', 'LIKE', '%'.$request->get('search_string').'%')
            ->limit(20)
            ->get();
        return response()->json($tags);
    }

    public function deleteBulk(BulkDeleteItemsRequest $request): \Illuminate\Http\RedirectResponse
    {
        $query = Tag::query()->whereIn('id', $request->item_list);
        try {
            if ($query->delete())
                return redirect()->back()->with('success', 'Записи успішно видалені');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return redirect()->back()->withErrors('Не вдалось видалити записи');
    }

    public function delete(Request $request) {
        $tag = Tag::query()->find($request->id);
        if (!$tag) {
            return redirect()->back()->withErrors('Не вдалось знайти хештег');
        }
        if ($tag->delete()) {
            return redirect()->back()->with('success', 'Тег успішно видалений');
        }
        return redirect()->back()->withErrors('Не вдалось видалити запис');
    }

    private function updateOrderOfRelated(Tag $article, $new_position) {
        if ($article->position < $new_position) {
            Tag::query()->whereBetween('position', [$article->position + 1, $new_position])
                ->update(['position' => DB::raw('position - 1')]);
        } else if($article->position > $new_position) {
            Tag::query()->whereBetween('position', [$new_position, $article->position - 1])
                ->update(['position' => DB::raw('position + 1')]);
        }
    }
    public function updatePosition(UpdatePositionRequest $request): \Illuminate\Http\JsonResponse
    {
        $tag = Tag::query()->find($request->id);
        if (!$tag) {
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
        try {
            $this->updateOrderOfRelated($tag, $request->position);
            $result = $tag->update([
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
}
