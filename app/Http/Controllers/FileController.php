<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoveItemRequest;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use App\Models\Favourite;
use App\Models\File;
use Illuminate\Http\JsonResponse;
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

    public function delete(Request $request) {
        $file = File::query()->where('user_id', $request->user()->id)->find($request->file_id);
        if (!$file) {
            return redirect()->back()->withErrors('Не знайдено файла');
        }
        $file->delete();
        if ($request->wantsJson())
            return new JsonResponse([
                'result' => true,
                'message' => 'Файл успішно видалено'
            ]);

        return redirect()->back()->with('success', 'Файо успішно видалено');
    }

    public function store(StoreFileRequest $request) {
        $article = CriminalArticle::query()->find($request->criminal_article_id);
        if (!$article) {
            return redirect()->back()->withErrors('Стаття з таким ідентифікаторм не знайдена');
        }
        $file = new File([
            'name' => $request->name,
            'nazva_pp' => $article->nazva_pp,
            'pp' => $article->pp,
            'statya_kk' => $article->statya_kk,
            'folder_id' => $request->folder_id,
            'user_id' => $request->user()->id,
            'criminal_article_id' => $article->id
        ]);
        if ($file->save()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'result' => true,
                    'message' => 'Файл успішно створений'
                ]);
            }
            return redirect()->back()->with('success', 'Файл успішно створений');
        }
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'result' => false,
                'error' => 'Неполадки на сервері, спробуйте пізніше',
                'message' => 'Неполадки на сервері, спробуйте пізніше'
            ]);
        }
        return redirect()->back()->withErrors('Неполадки на сервері, спробуйте пізніше', 500);
    }

    public function update(UpdateFileRequest $request) {
        $file = File::query()
            ->where('user_id', $request->user()->id)
            ->findOrFail($request->file_id);
        $result = $file->update($request->all());

        if ($request->wantsJson()) {
            return new JsonResponse([
                'result' => $result,
                'message' => $request
                    ? 'Файл збережено'
                    : 'Не вдалось зберегти файл'
            ]);
        }

        if ($result) {
            return redirect()->back()->with('success', 'Файл успішно оновлено');
        }
        return redirect()->back()->withErrors('Неполадки на сервері, спробуйте пізніше');
    }

    public function moveFile(MoveItemRequest $request): \Illuminate\Http\JsonResponse
    {
        $file = File::query()->where('user_id', $request->user()->id)->find($request->item_id);
        $result = $file->update($request->all());
        return response()->json([
            'success' => true,
            'result' => $result,
            'message' => $result
                ? 'Файл успішно переміщено'
                : 'Не вдалось перемістити файл'
        ]);
    }

    public function view(Request $request) {
        $file = File::query()->where('user_id', $request->user()->id)->findOrFail($request->id);
        return view('admin.file_manager.file', compact('file'));
    }
}
