<?php

namespace App\Http\Controllers;

use App\Enums\FolderType;
use App\Http\Requests\DeleteFolderRequest;
use App\Http\Requests\MoveItemRequest;
use App\Http\Requests\MoveFolderRequest;
use App\Http\Requests\StoreFolderRequest;
use App\Models\Favourite;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index() {

    }

    private function search(string|null $search_string, $folder_type, int $user_id): \Illuminate\Database\Eloquent\Collection|array
    {
        return Folder::query()
            ->where('user_id', $user_id)
            ->where('folder_type', $folder_type)
            ->where('name', 'LIKE', '%'.$search_string.'%')
            ->limit(20)
            ->get();
    }

    public function searchFavouriteFolders(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'search_string' => 'sometimes|string'
        ]);
        $folders = $this->search($request->search_string, FolderType::FAVOURITES_FOLDER, $request->user()->id);
        return response()->json($folders);
    }

    public function searchFileFolders(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'search_string' => 'sometimes|string'
        ]);
        $folders = $this->search($request->search_string, FolderType::FILE_FOLDER, $request->user()->id);
        return response()->json($folders);
    }

    public function view(Request $request, int $folder_id) {
        $folder = Folder::query()->where('user_id', $request->user()->id)->findOrFail($folder_id);
    }

    public function store(StoreFolderRequest $request) {
        $folder = new Folder(array_merge($request->all(), ['user_id' => $request->user()->id]));
        $result = $folder->save();

        if ($request->wantsJson()) {
            return new JsonResponse([
                'result' => $result,
                'message' => $result
                    ? 'Папка успішно створена'
                    : 'Не вдалось створити папку'
            ]);
        }

        if ($result) {
            return redirect()->back()->with('success', 'Папка успішно створена');
        }
        return redirect()->back()->withErrors('Папку не вдалось створити');
    }

    public function update(StoreFolderRequest $request) {
        $folder = Folder::query()->where('user_id', $request->user()->id)->find($request->folder_id);
        if (!$folder) {
            abort(404);
        }

        $result = $folder->update($request->all());

        if ($request->wantsJson())
            return new JsonResponse([
                'result' => $result,
                'message' => $result
                    ? 'Папка успішно оновлена'
                    : 'Не вдалось оновити папку'
            ]);

        if ($result) {
            return redirect()->back()->with('success', 'Папка успішно оновлена');
        }
        return redirect()->back()->withErrors('Папку не вдалось створити');
    }

    public function delete(DeleteFolderRequest $request) {
        $folder = Folder::query()->where('user_id', $request->user()->id)->find($request->folder_id);
        if ($folder !== null) {
            if ($folder->folder_type === FolderType::FAVOURITES_FOLDER) {
                Favourite::query()->where('folder_id', $folder->id)->delete();
            }
            $folder->delete();

            if ($request->wantsJson())
                return new JsonResponse([
                    'result' => true,
                    'message' => 'Папку успішно видалено з закладок'
                ]);

            return redirect()->back()->with('success', 'Папку успішно видалено');
        }
        return redirect()->back()->withErrors('Папку не знайдено');
    }

    public function moveFolder(MoveFolderRequest $request) {
        $folder = Folder::query()->where('user_id', $request->user()->id)->find($request->item_id);
        if (!$folder) {
            return response()->json([
                'error' => 'Не вдалось знайти папку'
            ]);
        }
        $result = $folder->update([
            'parent_id' => $request->folder_id
        ]);
        return response()->json([
            'success' => true,
            'id' => $folder->id,
            'result' => $result,
            'message' => $result
                ? 'Папка успішно переміщена'
                : 'Не вдалось перемістити папку'
        ]);
    }
}
