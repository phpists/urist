<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasFactory, HasSlug;


    const IMG_PATH = '/uploads/blog/';


    protected $fillable = [
        'is_main',
        'thumbnail',
        'slug',
        'title',
        'short_description',
        'content',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
        'is_main' => 'boolean'
    ];

    protected static function booted () {

        static::deleted(function(self $model) {
            \DB::table('blog_tag_relation')->where('blog_id', $model->id)->delete();
        });

    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->skipGenerateWhen(fn() => !empty($this->slug));
    }

    public function scopeCustomSorted($query)
    {
        return $query
            ->orderBy('is_main', 'DESC')
            ->orderBy('date', 'DESC');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_tag_relation');
    }

    public function getTagsIds(): array
    {
        return $this->tags->pluck('id')->toArray();
    }

    public function getThumbnailSrc()
    {
        $filePath = self::IMG_PATH . $this->thumbnail;

        if ($this->thumbnail && \Storage::fileExists($filePath))
            return \Storage::url($filePath);

        return null;
    }


}
