<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;

class ArticleController extends Controller
{

    public function index()
    {
        $categories = ArticleCategory::whereNull('parent_id')
            ->orderBy('position')
            ->with('children')
            ->get();

        return view('user.articles.index', compact('categories'));
    }

    public function show(CriminalArticle $article)
    {
        return view('user.articles.show', compact('article'));
    }

}
