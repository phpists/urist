<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Str;

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

        if (isset($data['slug']))
            $data['slug'] = Str::slug(parse_url($data['slug'], PHP_URL_PATH));

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $manager = new ImageManager(new Driver());
            $image = $manager->read($thumbnail->getRealPath());
            $image->scale(width: 600);
            $image->toPng()->save(Storage::path(Blog::IMG_PATH) . $thumbnail->hashName());
            $data['thumbnail'] = $thumbnail->hashName();
        }

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

        if (isset($data['slug']))
            $data['slug'] = Str::slug(parse_url($data['slug'], PHP_URL_PATH));

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $manager = new ImageManager(new Driver());
            $image = $manager->read($thumbnail->getRealPath());
            $image->scale(width: 600);
            $image->toPng()->save(Storage::path(Blog::IMG_PATH) . $thumbnail->hashName());
            $data['thumbnail'] = $thumbnail->hashName();
        }

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
