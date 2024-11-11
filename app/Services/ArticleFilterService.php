<?php

namespace App\Services;

use App\Enums\CriminalArticleTypeEnum;
use App\Enums\SettingEnum;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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
        return ArticleCategory::whereNull('parent_id')
            ->when($type = $this->getType(), function ($query) use ($type) {
                return $query->whereType($type);
            })
            ->orderBy('position')
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

        $isFromSearch = request()->has('search')
            && !empty(request('search'))
            && can_user(\App\Enums\PermissionEnum::SMART_SEARCH->value);

        $articles = $isFromSearch
            ? CriminalArticle::search(request('search'), function ($algolia, string $query, array $options) {
                $options['attributesToHighlight'] = ['name', 'description'];
                return $algolia->search($query, $options);
            })
            : CriminalArticle::query();

        $type = $this->getType();
        return $articles
//            ->when(!$isFromSearch && $type, function ($query) {
//                $query->whereType($this->getType());
//            })
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
            ->when($sort = request('sort', 'hierarchy'), function ($q) use ($sort, $isFromSearch) {
                match ($sort) {
                    'date' => $isFromSearch
                        ? $q->within('criminal_articles_date_desc')
                        : $q->orderBy('date', 'desc'),
                    default => $isFromSearch
                        ? $q->within('criminal_articles_hierarchy')
                        : $q->leftJoinSub(
                            DB::table('article_tags')
                                ->join('tags', 'tags.id', '=', 'article_tags.tag_id')
                                ->select(['article_tags.criminal_article_id', CriminalArticle::getTagPriorityRawSelect()])
                                ->groupBy('article_tags.criminal_article_id'),
                            'priority_tags',
                            function ($join) {
                                $join->on('criminal_articles.id', '=', 'priority_tags.criminal_article_id');
                            }
                        )
                            ->orderBy('priority_tags.tag_priority', 'desc')
                            ->orderBy('date', 'DESC'),
                };
            })
            ->paginate($perPage)
            ->withQueryString()
            ->through(function ($item) {
                $item->name = $item->scoutMetadata()['_highlightResult']['name']['value'] ?? $item->name;
                $item->description = $item->scoutMetadata()['_highlightResult']['description']['value'] ?? $item->description;
                return $item;
            });
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
