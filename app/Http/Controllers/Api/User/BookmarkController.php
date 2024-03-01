<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\FolderType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookmarkStoreRequest;
use App\Models\CriminalArticle;
use App\Models\Favourite;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parent_id = $request->input('parent_id');

        $column = 'id';
        $direction = 'desc';

        $search = $request->input('search');
        $sort = $request->input('sort');
        if ($sort)
            [$column, $direction] = explode(':', $sort);

        $folders = Folder::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_type', FolderType::FAVOURITES_FOLDER)
            ->where('parent_id', $parent_id)
            ->when($search, function ($q) use ($search) {
                foreach (explode(' ', $search) as $value) {
                    $q->where('name', 'LIKE', "%{$value}%");
                }
            })
            ->when($sort, function ($query) use ($column, $direction) {
                $query->orderBy($column, $direction);
            })
            ->get();
        $favourites = Favourite::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_id', $parent_id)
            ->when($search, function ($q) use($search) {
                foreach (explode(' ', $search) as $value) {
                    $q->where('name', 'LIKE', "%{$value}%");
                }
            })
            ->when($sort, function ($query) use ($column, $direction) {
                $query->orderBy($column, $direction);
            })
            ->get();

        return new JsonResponse([
            'folders' => $folders,
            'articles' => $favourites,
            'parent_id' => $parent_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookmarkStoreRequest $request)
    {
        $article = CriminalArticle::find($request->criminal_article_id);

        try {
            $bookmark = $request->user()->bookmarks()->create([
                'folder_id' => $request->folder_id,
                'criminal_article_id' => $article->id,
                'name' => $request->name ?? $article->name
            ]);

            return new JsonResponse([
                'result' => true,
                'message' => 'Статтю успішно додано в закладки',
                'bookmark' => $bookmark
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return new JsonResponse([
                'result' => false,
                'message' => 'ПОМИЛКА'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favourite $bookmark)
    {
        if ($bookmark->delete()) {
            return new JsonResponse([
                'result' => true,
                'message' => 'Закладку успішно видалено',
            ]);
        }

        return new JsonResponse([
            'result' => false,
            'message' => 'Не вдалось видалити закладку'
        ]);
    }
}
