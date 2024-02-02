<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class CriminalArticle extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'description',
        'court_decision_link',
        'article_category_id',
        'position',
        'is_active',
        'nazva_pp',
        'pp',
        'statya_kk',
    ];

    public function getPrettyCreatedAtAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
}
