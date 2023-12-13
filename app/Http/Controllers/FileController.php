<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoveFileRequest;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function search(Request $request)
    {
        $files = File::query()
            ->where('name', 'LIKE', "%" . $request->get('search_string') . "%")
            ->where('user_id', $request->user()->id)
            ->limit(30)
            ->get();
        return response()->json($files);
    }

    public function store(StoreFileRequest $request) {
        $article = CriminalArticle::query()->find($request->criminal_article_id);
        if (!$article) {
            return redirect()->back()->withErrors('Стаття з таким ідентифікаторм не знайдена');
        }
        $file = new File([
            'name' => $request->name,
            'content' => $article->content,
            'folder_id' => $request->folder_id,
            'user_id' => $request->user()->id
        ]);
        if ($file->save()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true
                ]);
            }
            return redirect()->back()->with('success', 'File successfully created');
        }
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'error' => 'Неполадки на сервері, спробуйте пізніше'
            ]);
        }
        return redirect()->back()->withErrors('Неполадки на сервері, спробуйте пізніше', 500);
    }

    public function update(UpdateFileRequest $request) {
        $file = File::query()
            ->where('user_id', $request->user()->id)
            ->findOrFail($request->file_id);
        if ($file->update($request->all())) {
            return redirect()->back()->with('success', 'Файл успішно оновлено');
        }
        return redirect()->back()->withErrors('Неполадки на сервері, спробуйте пізніше');
    }

    public function moveFile(MoveFileRequest $request) {
        $file = File::query()->where('user_id', $request->user()->id)->find($request->item_id);
        $file->update($request->all());
        return response()->json([
            'success' => true
        ]);
    }

    public function view(Request $request) {
        $file = File::query()->where('user_id', $request->user()->id)->findOrFail($request->id);
        return view('admin.file_manager.file', compact('file'));
    }
}
