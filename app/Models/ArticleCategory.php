<?php

namespace App\Models;

use App\Events\ArticleCategoryDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class ArticleCategory extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['name', 'parent_id', 'position', 'is_active', 'sub_title', 'type'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(CriminalArticle::class, 'criminal_article_categories');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ArticleCategory::class, 'parent_id')
            ->orderBy('position');
    }

    public function parent()
    {
        return $this->hasOne(ArticleCategory::class, 'id', 'parent_id');
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
        $ids = [];
        $categories = DB::select("
        SELECT id FROM article_categories WHERE id = ?
        UNION ALL
        SELECT c.id FROM article_categories c
        JOIN (
            SELECT id FROM article_categories WHERE id = ?
            UNION ALL
            SELECT id FROM article_categories WHERE parent_id IN (?)
        ) t ON c.parent_id = t.id
    ", [$category_id, $category_id, $category_id]);

        foreach ($categories as $category) {
            $ids[] = $category->id;
        }

        return $ids;

        $ids = [];
        $categories = self::with('children')->find($category_id);

        $stack = [$categories];
        while (!empty($stack)) {
            $category = array_pop($stack);
            $ids[] = $category->id;

            foreach ($category->children as $child) {
                $stack[] = $child;
            }
        }

        return $ids;
    }

    public function getFullPath()
    {
        $parent = $this->parent;
        $parents = [];
        do {
            if ($parent) {
                $parents[] = $parent?->name;
                $parent = $parent?->parent;
            }
        } while ($parent);

        uksort($parents, fn($a, $b) => -strnatcasecmp($a, $b));

        $parents[] = $this->name;

        return implode(' > ', $parents);
    }

    public static function getFullPathById($id)
    {
        return self::find($id)?->getFullPath();
    }

    public static function getNameById($id)
    {
        return self::find($id)?->name;
    }

}
