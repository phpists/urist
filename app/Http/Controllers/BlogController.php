<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(?string $blogTag = null)
    {
        if ($blogTag) {
            $currentBlogTag = BlogTag::whereSlug($blogTag)->firstOrFail();
            $blog = $currentBlogTag->blog();
        } else {
            $blog = Blog::query();
        }

        return view('blog.index', [
            'blogTags' => BlogTag::orderBy('pos')->get(),
            'blog' => $blog
                ->customSorted()
                ->paginate()
                ->withQueryString(),
            'currentBlogTag' => $currentBlogTag ?? null
        ]);
    }

    public function show(Blog $blog)
    {
        return view('blog.show', [
            'blog' => $blog
        ]);
    }

}
