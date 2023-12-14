<?php

namespace App\Models;

use App\Events\ArticleCategoryDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class ArticleCategory extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['name', 'parent_id'];

    public function articles(): HasMany
    {
        return $this->hasMany(CriminalArticle::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id')->with("children");
    }

    protected $dispatchesEvents = [
        'deleted' => ArticleCategoryDeleted::class
    ];
}
