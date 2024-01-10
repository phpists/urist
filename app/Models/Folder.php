<?php

namespace App\Models;

use App\Enums\FolderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $casts = [
        'folder_type' => FolderType::class
    ];

    protected $fillable = ['name', 'parent_id', 'folder_type', 'user_id'];

    public function files()
    {
        return match ($this->folder_type) {
            FolderType::FILE_FOLDER => $this->hasMany(File::class),
            FolderType::FAVOURITES_FOLDER => $this->hasMany(Favourite::class)
        };
    }

    public function getFilesCountTitle(): string
    {
        $count = $this->files()->count();

        if ($count == 1) {
            return "$count файл";
        } elseif ($count > 1 && $count < 5) {
            return "$count файла";
        } else {
            return "$count файлів";
        }
    }

}
