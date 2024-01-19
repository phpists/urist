<?php

namespace App\Services;

use App\Models\ArticleCategory;
use App\Models\CriminalArticle;

class ArticleFilterService
{

    public function getCategories()
    {
        return ArticleCategory::whereNull('parent_id')
            ->orderBy('position')
            ->with('children')
            ->get();
    }

    public function getArticles()
    {
        $categories = request('categories', []);
        foreach ($categories as $category)
            $categories = array_merge($categories, ArticleCategory::getChildIds($category));

        $categories = array_unique($categories);

        return CriminalArticle::when(!empty($categories), function ($q) use ($categories) {
            return $q->whereIn('article_category_id', $categories);
        })
            ->when($sort = request('sort'), function ($q) use ($sort) {
                [$column, $direction] = explode(':', $sort);

                if (isset($column) && isset($direction))
                    return $q->orderBy($column, $direction);

                return $q;
            })
            ->paginate()
            ->withQueryString();
    }

    public function getTotalCount(): int
    {
        return $this->getArticles()->total();
    }

    public function isCategoryActive($category_id): bool
    {
        return in_array($category_id, request('categories', []));
    }

}
