<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Services\CategoriesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{

    readonly private CategoriesService $categoriesService;

    public function __construct()
    {
        $this->categoriesService = new CategoriesService(request()->route('type'));
    }

    public function index(string $type, ?ArticleCategory $articleCategory = null)
    {
        $categories = $this->categoriesService->getCategories($articleCategory);

        return Response::json([
            'categories' => $categories
        ]);
    }

    public function search(string $type, Request $request)
    {
        $categories = $this->categoriesService->searchCategories($request->query('q'));

        return Response::json([
            'categories' => $categories
        ]);
    }

}
