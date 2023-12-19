<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CriminalArticle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content', 'article_category_id', 'position'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
}
