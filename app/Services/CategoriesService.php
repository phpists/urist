<?php

namespace App\Services;

use App\Models\ArticleCategory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CategoriesService
{

    public function __construct(public readonly string $type)
    {
    }

    final public function getCategories(?ArticleCategory $articleCategory = null): array
    {
        if (!$articleCategory)
            $articleCategory = ArticleCategory::whereType($this->type)->whereNull('parent_id')->first();

        $categories = $articleCategory->children()
            ->whereIsActive(1)
            ->select(['id', 'name', 'sub_title'])
            ->withCount('children')
            ->get()
            ->toArray();

        return Arr::map($categories, function ($category) {
            $category['checked'] = $this->isCategoryChecked($category['id']);
            $category['expanded'] = $this->isCategoryExpanded($category['id']);
            if ($category['expanded'])
                $category['children'] = $this->getCategories(ArticleCategory::find($category['id']));

            return $category;
        });
    }

    final public function searchCategories(string $q = ''): array
    {
        return $this->getCategoriesWithParents(
            ArticleCategory::whereType($this->type)
                ->whereisActive(1)
                ->where(function ($query) use ($q) {
                    $query->where('name', 'LIKE', '%' . $q . '%')
                        ->orWhere('sub_title', 'LIKE', '%' . $q . '%');
                })
                ->with('parent', 'parent.parent', 'parent.parent.parent', 'parent.parent.parent.parent', 'parent.parent.parent.parent.parent')
                ->select(['id', 'name', 'sub_title', 'parent_id'])
                ->get()
        );
    }

    private function getCategoriesWithParents(Collection $categories): array
    {
        $result = [];

        foreach ($categories as $category) {
            $current = $category;
            $path = [];

            while ($current) {
                $path[] = $current;
                $current = $current->parent;
            }

            $path = array_reverse($path);
            $result[] = $path;
        }

        return $this->buildNestedStructure($result);
    }

    private function buildNestedStructure(array $paths): array
    {
        $tree = [];

        foreach ($paths as $path) {
            $current = &$tree;

            foreach ($path as $category) {
                if ($category->parent_id === null) {
                    continue;
                }

                $id = $category->id;

                if (!isset($current[$id])) {
                    $current[$id] = [
                        'id' => $category->id,
                        'name' => $category->name,
                        'sub_title' => $category->sub_title,
                        'checked' => $this->isCategoryChecked($id),
                        'children' => [],
                    ];
                }

                $current = &$current[$id]['children'];
            }
        }

        return $tree;
    }

    private function isCategoryExpanded(int $categoryId): bool
    {
        $requestCategories = request('categories', []);
        $result = false;

        $categoryIds = ArticleCategory::getAllChildIds($categoryId);
        array_shift($categoryIds); // remove current

        foreach ($requestCategories as $requestCategoryId)
            if (in_array($requestCategoryId, $categoryIds))
                $result = true;

        return $result;
    }

    private function isCategoryChecked(int $categoryId): bool
    {
        return in_array($categoryId, request('categories', []));
    }

}
