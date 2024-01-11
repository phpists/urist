<?php

namespace App\Http\Controllers\User;

use App\Enums\FolderType;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function index(Request $request, string|null|int $folder_id = null) {
        $file_folder = null;
        if ($folder_id !== null) {
            $file_folder = Folder::query()
                ->where('user_id', $request->user()->id)
                ->where('folder_type', FolderType::FILE_FOLDER)
                ->find($folder_id);
            if (!$file_folder) {
                abort(404);
            }
        }
        $folders = Folder::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_type', FolderType::FILE_FOLDER)
            ->where('parent_id', $folder_id)
            ->get();
        $files = File::query()
            ->where('user_id', $request->user()->id)
            ->where('folder_id', $folder_id)
            ->get();

        return view('user.files.index', compact('folders', 'files', 'file_folder'));
    }

    public function edit(Request $request, File $file)
    {
        return view('user.files.edit', compact('file'));
    }

}
