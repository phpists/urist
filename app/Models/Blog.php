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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->skipGenerateWhen(fn() => !empty($this->slug));
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
