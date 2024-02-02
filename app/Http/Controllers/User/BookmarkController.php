<?php

namespace App\Http\Controllers\User;

use App\Enums\FolderType;
use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Folder;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{

    public function index(Request $request, string|null $folderId = null)
    {
        $fav_folder = null;
        if ($folderId !== null)
            $fav_folder = Folder::findOrFail($folderId);

        $search = \request('bookmarks_search');

        $folders = Folder::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_type', FolderType::FAVOURITES_FOLDER)
            ->where('parent_id', $folderId)
            ->when($search, function ($q) use($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            })
            ->get();
        $favourites = Favourite::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_id', $folderId)
            ->when($search, function ($q) use($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            })
            ->get();

        $parent_id = null;
        if ($folderId)
            $parent_id = $folderId;

        if ($request->ajax())
            return view('user.bookmark._items', compact('fav_folder', 'folders', 'favourites', 'parent_id'));

        return view('user.bookmark.index', compact('fav_folder', 'folders', 'favourites', 'parent_id'));
    }

}
