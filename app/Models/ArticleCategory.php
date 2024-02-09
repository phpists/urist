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

    protected $fillable = ['name', 'parent_id', 'position', 'is_active', 'sub_title'];

    public function articles(): HasMany
    {
        return $this->hasMany(CriminalArticle::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id')
            ->orderBy('position');
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id')
            ->with("children")
            ->orderBy('position');
    }

    protected $dispatchesEvents = [
        'deleted' => ArticleCategoryDeleted::class
    ];


    public static function getChildIds($category_id): array
    {
        $ids = [$category_id];
        $category = self::find($category_id);

        if ($category->children) {
            foreach ($category->children as $subcategory) {
                $ids = array_merge($ids, self::getChildIds($subcategory->id));
            }
        }

        return $ids;
    }

}
