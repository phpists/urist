<?php

namespace App\Services;

use App\Enums\CriminalArticleTypeEnum;
use App\Enums\SettingEnum;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ArticleFilterService
{

    public function __construct(public ?string $type = null)
    {
    }

    public function getType(): ?string
    {
        return $this->type ?? null;
    }

    public function getCategories()
    {
        $mainCategory = ArticleCategory::whereNull('parent_id')
            ->when($type = $this->getType(), function ($query) use ($type) {
                return $query->whereType($type);
            })
            ->orderBy('position')
            ->with([
                'children',
                'children.children',
                'children.children.children',
                'children.children.children.children',
                'children.children.children.children.children',
                'children.children.children.children.children.children',
                'children.children.children.children.children.children.children',
                'children.children.children.children.children.children.children.children',
            ])
            ->first();

        return $mainCategory->children;
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

        $isFromSearch = request()->has('search')
            && !empty(request('search'))
            && request()->user()->can(\App\Enums\PermissionEnum::SMART_SEARCH->value);

        $articles = $isFromSearch
            ? CriminalArticle::search(request('search'))
            : CriminalArticle::query();

        $type = $this->getType();
        return $articles
            ->when(!$isFromSearch && $type, function ($query) {
                $query->whereType($this->getType());
            })
            ->when((!empty($categories)), function ($q) use ($categories, $isFromSearch) {
                if ($isFromSearch) {
                    $filterCategories = \Arr::map($categories, function ($category) {
                        return "categories={$category}";
                    });

                    return $q->with([
                        'filters' => implode(' OR ', $filterCategories)
                    ]);
                } else {
                    return $q->whereHas('categories', function ($q) use ($categories) {
                        return $q->whereIn('article_categories.id', $categories);
                    });
                }
            })
            ->when($sort = request('sort'), function ($q) use ($sort, $isFromSearch) {
                [$column, $direction] = explode(':', $sort);

                if (isset($column) && isset($direction)) {
                    if ($isFromSearch) {
                        return $q->within('criminal_articles_date_' . strtolower($direction));
                    } else {
                        return $q->orderBy($column, $direction);
                    }
                }

                return $q;
            })
            ->when(!$sort, function ($query) use ($isFromSearch) { // default sort
                if ($isFromSearch) {
                    return $query->within('criminal_articles_date_desc');
                } else {
                    return $query->orderBy('date', 'DESC');
                }
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
