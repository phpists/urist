<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class CriminalArticle extends Model
{
    use HasFactory, Searchable;

    const TAGS_PRIORITY = [
        'ВП ВС' => 4,
        'ОП ККС ВС' => 3,
        'ККС ВС' => 2,
    ];

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
        'date' => 'date:Y-m-d',
    ];

    protected $with = [
        'tags'
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
            'date_timestamp' => $this->date->timestamp,
            'tag_priority' => (int) $this->tags()
                ->select($this::getTagPriorityRawSelect(false))
                ->get()
                ->sortByDesc('tag_priority')
                ->first()
                ?->tag_priority,
        ];
    }

    public static function getTagPriorityRawSelect(bool $max = true, string $attr = 'tag_priority'): Expression
    {
        $whens = [];
        foreach (self::TAGS_PRIORITY as $key => $value)
            $whens[] = "WHEN tags.name = '". $key ."' THEN ". $value;

        return DB::raw(($max ? 'MAX(' : '') ."
               CASE
                   ". implode("\r\n", $whens) ."
                   ELSE 1
               END
            ". ($max ? ')' : '') ." AS ". $attr);
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

    public function getTagsHtml(string $url): string
    {
        return $this->tags?->map(function($tag) use ($url) {
            return '<a class="collection-table__info" href="'.$url.'" style="'.$tag->style_color.$tag->style_border_color.'">'.$tag->name.'</a>';
        })->join('');
    }

    public function getProgramTitle(): string
    {
        return \Str::slug($this->name);
    }

    public function getExportableFileName(): string
    {
        return strtolower(config('app.name') . '_' . \Str::slug($this->getProgramTitle())) . '.docx';
    }

    public function getSearchHighlightedName()
    {
        $name = $this->name;
        $words = $this->scoutMetadata()['_highlightResult']['name']['matchedWords'] ?? [];

        if (!empty($words)) {
            foreach ($words as $word)
                $name = \Str::replace($word, "<span style='background-color: yellow'>{$word}</span>", $name);
        }

        return $name;
    }

    public function getSearchHighlightedDescription()
    {
        $description = $this->description;
        $words = $this->scoutMetadata()['_highlightResult']['description']['matchedWords'] ?? [];

        if (!empty($words)) {
            foreach ($words as $word)
                $description = \Str::replace($word, "<span style='background-color: yellow'>{$word}</span>", $description);
        }

        return $description;
    }

}
