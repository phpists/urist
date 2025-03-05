<?php

namespace App\Http\Controllers\User;

use App\Models\ArticleCategory;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class CategoryController
{

    readonly private CategoriesService $categoriesService;

    public function __construct()
    {
        $this->categoriesService = new CategoriesService(request()->route('type'));
    }

    public function index(string $type, ?ArticleCategory $articleCategory = null)
    {
        $categories = $this->categoriesService->getCategories($articleCategory);

        return view('user.categories.index', compact('categories', 'type'));
    }

    public function search(string $type, Request $request)
    {
        $search = $request->query('q');
        $categories = $this->categoriesService->searchCategories($search);

        return view('user.categories.index', compact('categories', 'type', 'search'));
    }

}
