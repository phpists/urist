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
        if ($folderId !== null) {
            $fav_folder = Folder::query()
                ->where('user_id', $request->user()->id)
                ->where('folder_type', FolderType::FAVOURITES_FOLDER->value)
                ->find($folderId);
            if (!$fav_folder) {
                abort(404);
            }
        }
        $folders = Folder::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_type', FolderType::FAVOURITES_FOLDER)
            ->where('parent_id', $folderId)
            ->get();
        $favourites = Favourite::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_id', $folderId)
            ->get();

        $parent_id = null;
        if ($folderId)
            $parent_id = $folderId;

        return view('user.bookmark.index', compact('fav_folder', 'folders', 'favourites', 'parent_id'));
    }

}
