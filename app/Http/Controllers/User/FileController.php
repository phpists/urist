<?php

namespace App\Http\Controllers\User;

use App\Enums\FolderType;
use App\Enums\PermissionEnum;
use App\Enums\SystemPageEnum;
use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\File;
use App\Models\Folder;
use App\Services\ExportDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\Table;

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
        $favourites = Favourite::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_id', $folder_id)
            ->when($search, function ($q) use($search) {
                foreach (explode(' ', $search) as $value) {
                    $q->where('name', 'LIKE', "%{$value}%");
                }
            })
            ->when($sort, function ($query) use ($column, $direction) {
                $query->orderBy($column, $direction);
            })
            ->get();

        if ($request->ajax())
            return view('user.files._items', compact('file_folder', 'folders', 'files', 'favourites'));

        $systemPage = SystemPageEnum::USER_CABINET->getPage();

        return view('user.files.index', compact('folders', 'files', 'file_folder', 'folder_id', 'favourites', 'systemPage'));
    }

    public function edit(Request $request, File $file)
    {
        return view('user.files.edit', compact('file'));
    }

    public function updateFileName(Request $request, File $file)
    {
        can_user(PermissionEnum::MARK_NEEDED->value);

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

    public function exportDoc(Request $request, File $file)
    {
        can_user(PermissionEnum::EXPORT_PAGE->value);
        ExportDocument::download($file);
    }

}
