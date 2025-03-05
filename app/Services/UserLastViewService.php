<?php

namespace App\Services;

use App\Enums\CriminalArticleTypeEnum;
use Illuminate\Support\Facades\Cache;

class UserLastViewService
{
    static public function rememberCategory(string $type, array $categories = [], string $sort = ''): void
    {
        Cache::put(self::getCategoryCacheKey(), [
            'type' => $type,
            'query' => compact('categories', 'sort'),
        ]);
    }

    static public function getCategory(): array
    {
        return Cache::get(self::getCategoryCacheKey(), [
            'type' => CriminalArticleTypeEnum::KK->value,
            'query' => [
                'categories' => [],
                'sort' => null
            ]
        ]);
    }

    static public function getCategoryUrl(): ?string
    {
        $data = self::getCategory();

        return route('user.articles.index', [
            'type' => $data['type'],
            ...$data['query']
        ]);
    }

    static private function getCategoryCacheKey(): string
    {
        return 'user:' . request()->user()->id . ':last-category';
    }


    static public function rememberArticle(int $id): void
    {
        Cache::put(self::getArticleCacheKey(), $id);
    }

    static public function getArticle(): ?int
    {
        return Cache::get(self::getArticleCacheKey());
    }

    static private function getArticleCacheKey(): string
    {
        return 'user:' . request()->user()->id . ':last-article';
    }
}
