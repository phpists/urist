<?php

namespace App\Http\Controllers;

use App\Enums\FolderType;
use App\Models\Favourite;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index(Request $request, string|null $folder_id = null) {
        $fav_folder = null;
        if ($folder_id !== null) {
            $folder = Folder::query()
                ->where('user_id', $request->user()->id)
                ->where('folder_type', FolderType::FAVOURITES_FOLDER->value)
                ->find($folder_id);
            if (!$folder) {
                abort(404);
            }
        }
        $folders = Folder::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_type', FolderType::FAVOURITES_FOLDER)
            ->where('parent_id', $folder_id)
            ->get();
        $favourites = Favourite::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_id', $folder_id)
            ->get();
        return view('admin.favourites.index', compact('folders', 'favourites', 'fav_folder'));
    }

    public function delete(Request $request) {
        $favourite = Favourite::query()->where('user_id', $request->user()->id)->find($request->favourite_id);
        if (!$favourite) {
            return redirect()->back()->withErrors('Не знайдено папки з даним ідентифікаторм');
        }
        $favourite->delete();
        return redirect()->back()->with('success', 'Успішно видалено з закладок');
    }

    public function search(Request $request)
    {
        $favourites = Favourite::query()
            ->where('name', 'LIKE', "%" . $request->get('search_string') . "%")
            ->where('user_id', $request->user()->id)
            ->limit(30)
            ->get();
        return response()->json($favourites);
    }
}
