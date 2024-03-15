<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BlogResource;
use App\Http\Resources\Api\BlogTagResource;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function __construct(private readonly BlogService $blogService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return BlogResource::collection($this->blogService->getArticles($request->query('tag')));
    }

    public function tags()
    {
        return $this->blogService->getTags();
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $article)
    {
        return $article;
    }

}
