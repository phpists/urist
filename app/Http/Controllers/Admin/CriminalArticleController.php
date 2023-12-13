<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavouriteRequest;
use App\Models\ArticleCategory;
use App\Models\CriminalArticle;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CriminalArticleController extends Controller
{
    public function index() {
        $criminal_articles = CriminalArticle::query()->with('category')->paginate(30);
        return view('admin.criminal_articles.index', compact('criminal_articles'));
    }
    public function create() {
        return view('admin.criminal_articles.create');
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:criminal_articles',
            'content' => 'string|required',
            'article_category_id' => 'required|exists:article_categories,id'
        ]);
        $article = new CriminalArticle($validatedData);
        $article->save();
        return redirect()->back()->with('success', 'Article saved correct');
    }
    public function update(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:criminal_articles',
            'content' => 'string|required',
            'article_category_id' => 'required|exists:article_categories,id'
        ]);
        $article = CriminalArticle::query()->find($request->id);
        if (!$article) {
            return redirect()->back()->withErrors('Article with such id not found');
        }
        $article->update($validatedData);
        return redirect()->back()->with('success', 'Article saved correct');
    }
    public function delete(string $id) {
        $article = CriminalArticle::query()->find($id);
        if (!$article) {
            return redirect()->back()->withErrors('Стаття не знайдена');
        }
        $article->delete();
        return redirect()->back()->with('success', 'Article deleted correct');
    }

    public function edit(string $id) {
        $criminal_article = CriminalArticle::query()->findOrFail($id);
        return view('admin.criminal_articles.edit', compact('criminal_article'));
    }

    public function search(Request $request) {
        $criminal_articles = CriminalArticle::query()
            ->where('name', 'LIKE', '%'.$request->get('search_string').'%')
            ->limit(20)
            ->get();
        return response()->json($criminal_articles);
    }

    public function addToFavourites(StoreFavouriteRequest $request) {
        $article = CriminalArticle::query()->find($request->criminal_article_id);
        if (!$article) {
            return response()->json([
                'error' => 'Article not found'
            ], 404);
        }
        $favourite = new Favourite([
            'user_id' => $request->user()->id,
            'folder_id' => $request->folder_id,
            'criminal_article_id' => $request->criminal_article_id,
            'name' => $request->name
        ]);
        if ($favourite->save())
            return redirect()->back()->with('success', 'Додано в закладки');
        return redirect()->back()->withErrors('Помилка при збереженні, спробуйте пізніше');
    }
}
