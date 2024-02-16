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
        'pp',
        'statya_kk',
        'date'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function getPrettyCreatedAtAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }

    public function getPrettyDateAttribute()
    {
        return $this->date?->format('d.m.Y');
    }

    /** @deprecated  */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, (new CriminalArticleCategory)->getTable());
    }

    public function criminalArticleCategories()
    {
        return $this->hasMany(CriminalArticleCategory::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    public function getTagsString(): string
    {
        return implode(', ', $this->tags->pluck('name')->toArray() ?? []);
    }

}
