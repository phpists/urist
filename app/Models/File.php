<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    const EXTENSION = '.docx';

    protected $fillable = ['name', 'content', 'folder_id', 'user_id'];

    public function folder() {
        return $this->belongsTo(Folder::class);
    }
}
