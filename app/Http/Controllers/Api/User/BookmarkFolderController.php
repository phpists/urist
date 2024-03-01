<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\FolderType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookmarkFolderStoreRequest;
use App\Http\Requests\Api\BookmarkFolderUpdateRequest;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;

class BookmarkFolderController extends Controller
{

    public function store(BookmarkFolderStoreRequest $request)
    {
        try {
            $folder = $request->user()->bookmarkFolders()->create([
                'name' => $request->name,
                'folder_type' => FolderType::FAVOURITES_FOLDER->value,
                'parent_id' => $request->parent_id
            ]);

            return new JsonResponse([
                'result' => true,
                'message' => 'Папка успішно створена',
                'folder' => $folder
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return new JsonResponse([
                'result' => false,
                'message' => 'Не вдалось створити папку'
            ]);
        }
    }

    public function update(BookmarkFolderUpdateRequest $request, Folder $folder)
    {
        if ($folder->update($request->validated())) {
            return new JsonResponse([
                'result' => true,
                'message' => 'Папка успішно оновлена',
                'folder' => $folder
            ]);
        }

        return new JsonResponse([
            'result' => false,
            'message' => 'Не вдалось оновити папку'
        ]);
    }

    public function destroy(Folder $folder)
    {
        if ($folder->delete()) {
            return new JsonResponse([
                'result' => true,
                'message' => 'Папка успішно видалена',
            ]);
        }

        return new JsonResponse([
            'result' => false,
            'message' => 'Не вдалось видалити папку'
        ]);
    }

}
