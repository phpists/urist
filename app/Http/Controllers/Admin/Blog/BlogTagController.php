<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{

    public function index(Request $request)
    {
        return view('admin.blog.tags.index', [
            'blogTags' => BlogTag::orderBy('pos')->get()
        ]);
    }

    public function sort(Request $request)
    {
        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {
                $model = BlogTag::findOrFail($position['id']);
                $model->pos = $position['pos'];
                $model->save();
            }
        }
    }

    public function show(Request $request, BlogTag $blogTag)
    {
        if ($request->wantsJson())
            return $blogTag;

        return back();
    }

    public function store(Request $request)
    {
        $blogTag = new BlogTag($request->only(['title', 'slug']));

        if ($blogTag->save()) {
            return back()->with('success', 'Хештег додано');
        }

        return back()->with('error', 'Не вдалось зберегти хештег');
    }

    public function update(Request $request, BlogTag $blogTag)
    {
        if ($blogTag->update($request->only(['title', 'slug']))) {
            return back()->with('success', 'Дані оновлено');
        }

        return back()->with('error', 'Не вдалось оновити дані');
    }

    public function destroy(Request $request, BlogTag $blogTag)
    {
        if ($blogTag->delete()) {
            return back()->with('success', 'Хештег видалено');
        } else {
            return back()->with('error', 'Не вдалось видалити хештег');
        }
    }

    public function bulkDelete(Request $request)
    {
        $result = BlogTag::whereIn('id', json_decode($request->post('ids')))
            ->get()
            ->each(function ($item) {
                $item->delete();
            });
        if ($result) {
            return back()->with('success', 'Хештеги видалено');
        } else {
            return back()->with('error', 'Не вдалось видалити хештеги');
        }
    }

}
