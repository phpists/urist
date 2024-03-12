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
        'date',
        'type'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    protected static function booted () {

        static::deleted(function(self $model) {
            File::whereCriminalArticleId($model->id)->delete();
            Favourite::whereCriminalArticleId($model->id)->delete();
        });

    }


    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    final public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'categories' => $this->categories()->pluck('article_categories.id')->toArray(),
            'date_timestamp' => $this->date->timestamp
        ];
    }



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

    public function getTagsArray(): array
    {
        return $this->tags?->pluck('name')?->toArray() ?? [];
    }

    public function getTagsString(): string
    {
        return implode(', ', $this->getTagsArray());
    }

    public function getDescriptionWithHighlightedWord(string $word = null): string
    {
        if (!$word)
            return $this->description;

        return \Str::replace($word, "<span style='background-color: yellow'>{$word}</span>", $this->description);
    }

}
