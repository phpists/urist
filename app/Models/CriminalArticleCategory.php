<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriminalArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'criminal_article_id',
        'article_category_id',
    ];

}
