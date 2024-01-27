<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $blog = Blog::when($tags = $request->get('tags'), function ($q) use ($tags) {
            return $q->whereHas('tags', function ($q) use($tags) {
                return $q->whereIn('blog_tags.id', $tags);
            });
        })
            ->when($search = $request->get('search'), function ($q) use($search) {
                return $q->where('title', 'LIKE', "%{$search}%");
            })
            ->orderBy('id', 'DESC')
            ->paginate()
            ->withQueryString();

        if ($request->ajax()) {
            return new JsonResponse([
                'html' => view('admin.blog.articles.parts.table', [
                    'blog' => $blog
                ])->render()
            ]);
        }

        return view('admin.blog.articles.index', [
            'blog' => $blog,
            'blogTags' => BlogTag::all()
        ]);
    }

    public function create()
    {
        return view('admin.blog.articles.create', [
            'model' => new Blog(),
            'blogTags' => BlogTag::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_main'] = $request->boolean('is_main');
        $data['thumbnail'] = null;

        if ($request->hasFile('thumbnail'))
            if (Storage::put(Blog::IMG_PATH, $file = $request->file('thumbnail')))
                $data['thumbnail'] = $file->hashName();

        $blog = new Blog($data);
        if ($blog->save()) {
            if (isset($data['tags']))
                foreach ($data['tags'] as $tag)
                    \DB::table('blog_tag_relation')->insert([
                        'blog_id' => $blog->id,
                        'blog_tag_id' => $tag
                    ]);

            return to_route('admin.blog.edit', $blog)->with('success', 'Стаття успішно збережена');
        }

        return back()->with('error', 'Не вдалось зберегти дані');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.articles.edit', [
            'model' => $blog,
            'blogTags' => BlogTag::all()
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->all();
        $data['is_main'] = $request->boolean('is_main');

        if ($request->hasFile('thumbnail'))
            if (Storage::put(Blog::IMG_PATH, $file = $request->file('thumbnail')))
                $data['thumbnail'] = $file->hashName();

        $result = $blog->update($data);

        if ($result) {
            if (isset($data['tags'])) {
                \DB::table('blog_tag_relation')->where('blog_id', $blog->id)->delete();
                foreach ($data['tags'] as $tag)
                    \DB::table('blog_tag_relation')->insert([
                        'blog_id' => $blog->id,
                        'blog_tag_id' => $tag
                    ]);
            }
        }

        if ($request->wantsJson())
            return new JsonResponse([
                'result' => $result
            ]);

        if ($result)
            return to_route('admin.blog.edit', $blog)->with('success', 'Стаття успішно оновлена');
        else
            return back()->with('error', 'Не вдалось зберегти зміни');
    }

    public function destroy(Request $request, Blog $blog)
    {
        if ($blog->delete()) {
            return back()->with('success', 'Статтю видалено');
        } else {
            return back()->with('error', 'Не вдалось видалити статтю');
        }
    }

    public function bulkDelete(Request $request)
    {
        $result = Blog::whereIn('id', json_decode($request->post('ids')))
            ->get()
            ->each(function ($item) {
                $item->delete();
            });
        if ($result) {
            return back()->with('success', 'Статті видалено');
        } else {
            return back()->with('error', 'Не вдалось видалити статті');
        }
    }

}
