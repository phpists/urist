<?php

namespace App\Http\Controllers;

use App\Enums\FolderType;
use App\Models\ArticleCategory;
use App\Models\Favourite;
use App\Models\Folder;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function welcome(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('user.index');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function favourites(Request $request, string|null $folder_id = null) {
        $fav_folder = null;
        if ($folder_id !== null) {
            $fav_folder = Folder::query()
                ->where('user_id', $request->user()->id)
                ->where('folder_type', FolderType::FAVOURITES_FOLDER->value)
                ->find($folder_id);
            if (!$fav_folder) {
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
        return view('user.favourites', compact('fav_folder', 'folders', 'favourites'));
    }

    public function collection() {
        $categories = ArticleCategory::query()->whereNull('parent_id')->orderBy('position')->with('children')->get();
        return view('user.collection', compact('categories'));
    }

    public function editPage() {
        return view('user.edit-page');
    }

    public function article() {
        return view('user.article');
    }

    public function subscription() {
        return view('user.subscription');
    }
}
