<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\FolderType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Files\FileFolderStoreRequest;
use App\Http\Requests\Api\User\Files\FileFolderUpdateRequest;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileFolderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileFolderStoreRequest $request)
    {
        try {
            $folder = $request->user()->fileFolders()->create([
                'name' => $request->name,
                'folder_type' => FolderType::FILE_FOLDER->value,
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

    /**
     * Update the specified resource in storage.
     */
    public function update(FileFolderUpdateRequest $request, Folder $folder)
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

    /**
     * Remove the specified resource from storage.
     */
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
