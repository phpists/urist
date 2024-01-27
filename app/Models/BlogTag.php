<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogTag extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'pos',
        'title',
        'slug'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->skipGenerateWhen(fn() => !empty($this->slug));
    }

    protected static function booted () {

        static::deleted(function(self $model) {
            \DB::table('blog_tag_relation')->where('blog_tag_id', $model->id)->delete();
        });

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function blog()
    {
        return $this->hasManyThrough(
            Blog::class,
            BlogTagRelation::class,
            'blog_tag_id',
            'id',
            'id',
            'blog_id'
        );
    }


}
