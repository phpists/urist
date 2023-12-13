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
}
