<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\BlogTag;

class BlogService
{

    public function getArticles(?string $tag = null)
    {
        if ($tag) {
            $currentBlogTag = BlogTag::whereSlug($tag)->firstOrFail();
            $blog = $currentBlogTag->blog();
        } else {
            $blog = Blog::query();
        }

        return $blog
            ->customSorted()
            ->paginate()
            ->withQueryString();
    }

    public function getTags()
    {
        return BlogTag::orderBy('pos')->get();
    }

}
