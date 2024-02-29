<?php

namespace App\Http\Controllers\User;

use App\Enums\FolderType;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function index(Request $request, string|null|int $folder_id = null) {
        $file_folder = null;
        if ($folder_id !== null)
            $file_folder = Folder::findOrFail($folder_id);

        $column = 'id';
        $direction = 'desc';

        $search = \request('bookmarks_search');
        $sort = $request->input('sort');
        if ($sort)
            [$column, $direction] = explode(':', $sort);

        $folders = Folder::query()
            ->when($search, function ($q) use ($search) {
                foreach (explode(' ', $search) as $value) {
                    $q->where('name', 'LIKE', "%{$value}%");
                }
            })
            ->when($sort, function ($query) use ($column, $direction) {
                $query->orderBy($column, $direction);
            })
            ->where('user_id', $request->user()->id)
            ->where('folder_type', FolderType::FILE_FOLDER)
            ->where('parent_id', $folder_id)
            ->get();
        $files = File::query()
            ->when($search, function ($q) use($search) {
                foreach (explode(' ', $search) as $value) {
                    $q->where('name', 'LIKE', "%{$value}%");
                }
            })
            ->when($sort, function ($query) use ($column, $direction) {
                $query->orderBy($column, $direction);
            })
            ->where('user_id', $request->user()->id)
            ->where('folder_id', $folder_id)
            ->get();

        if ($request->ajax())
            return view('user.files._items', compact('file_folder', 'folders', 'files'));

        return view('user.files.index', compact('folders', 'files', 'file_folder', 'folder_id'));
    }

    public function edit(Request $request, File $file)
    {
        return view('user.files.edit', compact('file'));
    }

    public function updateFileName(Request $request, File $file)
    {
        $result = $file->update(['name' => $request->post('name')]);

        if ($request->wantsJson()) {
            return new JsonResponse([
                'result' => $result,
                'message' => $request
                    ? 'Файл збережено'
                    : 'Не вдалось зберегти файл'
            ]);
        }

        return back();
    }

}
