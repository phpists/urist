<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    const EXTENSION = '.docx';

    protected $fillable = ['name', 'folder_id', 'user_id', 'criminal_article_id', 'statya_kk', 'pp'];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function folder() {
        return $this->belongsTo(Folder::class);
    }

    public function criminalArticle()
    {
        return $this->belongsTo(CriminalArticle::class);
    }

    public function getProgramTitle(): string
    {
        return \Str::replace(' ', '_', $this->name);
    }

    public function getPrettyCreatedAtAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }

}
