<?php

namespace App\Services;

use App\Enums\SettingEnum;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use Illuminate\Support\Facades\Cache;

class ArticleFilterService
{

    public function getCategories()
    {
        return ArticleCategory::whereNull('parent_id')
            ->orderBy('position')
            ->with('children')
            ->get();
    }

    public function isMustBeExpanded(ArticleCategory $category): bool
    {
        $result = false;
        $category_ids = ArticleCategory::getChildIds($category->id);

        foreach (request('categories', []) as $request_category_id) {
            if (in_array($request_category_id, $category_ids)) {
                $result = true;
            }
        }

        return $result;
    }

    public function getArticles()
    {
        $perPage = SettingService::getValueByName(SettingEnum::CRIMINAL_ARTICLES_PER_PAGE->value) ?? 20;
        $categories = request('categories', []);
        foreach ($categories as $category)
            $categories = array_merge($categories, ArticleCategory::getChildIds($category));

        $categories = array_unique($categories);

        $isFromSearch = request()->has('search');

        $articles = $isFromSearch
            ? CriminalArticle::search(request('search'))
            : CriminalArticle::query();

        return $articles
            ->when((!$isFromSearch && !empty($categories)), function ($q) use ($categories) {
                return $q->whereHas('categories', function ($q) use ($categories) {
                    return $q->whereIn('article_categories.id', $categories);
                });
            })
            ->when($sort = request('sort'), function ($q) use ($sort) {
                [$column, $direction] = explode(':', $sort);

                if (isset($column) && isset($direction))
                    return $q->orderBy($column, $direction);

                return $q;
            })
            ->when(!$sort, function ($query) { // default sort
                $query->orderBy('date', 'DESC');
            })
            ->paginate($perPage)
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
