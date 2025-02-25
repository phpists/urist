<?php

namespace App\Http\Controllers\Api\User;

use App\Enums\FolderType;
use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Files\FileStoreRequest;
use App\Http\Requests\Api\User\Files\FileUpdateRequest;
use App\Http\Requests\Api\User\Files\NewRequest;
use App\Models\CriminalArticle;
use App\Models\Favourite;
use App\Models\File;
use App\Models\Folder;
use App\Services\ExportDocument;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class FileController extends Controller
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
            ->with('childs')
            ->where('user_id', $request->user()->id)
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

        $folders->map(function ($folder) {
            $folder->files_count = $folder->getFilesCount();
            $folder->bookmarks_count = $folder->getBookmarksCount();
            $folder->items_count = $folder->files_count + $folder->bookmarks_count;
            $folder->items_count_text = $folder->getTotalEntriesCountTitle();

//            $folder->unsetRelation('childs');
        });

        $files = File::query()
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
        $bookmarks = Favourite::query()
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
            'files' => $files,
            'bookmarks' => $bookmarks,
            'parent_id' => $parent_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileStoreRequest $request)
    {
        $article = CriminalArticle::find($request->criminal_article_id);

        try {
            $file = $request->user()->files()->create([
                'folder_id' => $request->folder_id,
                'criminal_article_id' => $article->id,
                'name' => $request->name ?? $article->name,
                'pp' => $article->pp,
                'statya_kk' => $article->statya_kk
            ]);

            return new JsonResponse([
                'result' => true,
                'message' => 'Файл успішно створено',
                'file' => $file
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
    public function show(File $file)
    {
        return $file;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FileUpdateRequest $request, File $file)
    {
        try {
            $data = $request->validated();
            $data['folder_id'] = $request->post('folder_id');
            $file->update($data);

            return new JsonResponse([
                'result' => true,
                'message' => 'Файл успішно оновлено',
                'file' => $file
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
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        if ($file->delete()) {
            return new JsonResponse([
                'result' => true,
                'message' => 'Файл успішно видалено',
            ]);
        }

        return new JsonResponse([
            'result' => false,
            'message' => 'Не вдалось видалити файл'
        ]);
    }

    public function exportDoc(Request $request, File $file)
    {
        can_user(PermissionEnum::EXPORT_PAGE->value);
        ExportDocument::download($file);
    }

    public function newFile(NewRequest $request)
    {
        $file = new File([
            'name' => $request->name,
            'pp' => FileService::getDocumentContent($request->file('document')),
            'statya_kk' => '',
            'folder_id' => $request->folder_id,
            'user_id' => $request->user()->id,
        ]);

        if ($file->save()) {
            return new JsonResponse([
                'result' => true,
                'message' => 'Файл успішно створено',
                'file' => $file
            ]);
        }

        return new JsonResponse([
            'result' => false,
            'message' => 'Не вдалось видалити файл'
        ]);
    }

}
