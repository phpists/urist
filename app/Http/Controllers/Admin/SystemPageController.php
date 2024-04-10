<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemPageController extends Controller
{

    public function edit(SystemPage $systemPage)
    {
        if (!view()->exists("admin.system-pages.{$systemPage->name}"))
            abort(404);

        return view("admin.system-pages.{$systemPage->name}", [
            'model' => $systemPage
        ]);
    }

    public function update(Request $request, SystemPage $systemPage)
    {
        $systemPage->title = $request->post('title');

        $data = $request->post('data', []);
        foreach ($request->allFiles()['data'] ?? [] as $dI => $datum) {
            if (isset($datum['items'])) {
                foreach ($datum['items'] as $iI => $item) {
                    if (isset($item['img'])) {
                        if (Storage::put(SystemPage::IMG_PATH, $item['img'])) {
                            $oldImg = $systemPage->getDataImgSrcByDot("{$dI}.items.{$iI}.img");
                            if ($oldImg && !str_contains($oldImg, '/assets/img'))
                                Storage::delete(SystemPage::IMG_PATH . $oldImg);

                            $data[$dI]['items'][$iI]['img'] = $item['img']->hashName();
                        }
                    }
                }
            }
        }
        $systemPage->data = $data;

        $images = $systemPage->images ?? [];
        foreach ($request->allFiles()['images'] ?? [] as $i => $file) {
            if (Storage::put(SystemPage::IMG_PATH, $file)) {
                if ($systemPage->getImageSrc($i))
                    Storage::delete(SystemPage::IMG_PATH . $systemPage->images[$i]);

                $images[$i] = $file->hashName();
            }
        }

        $systemPage->images = $images;

        $systemPage->meta = $request->post('meta', []);

        if ($systemPage->save()) {
            return to_route('admin.system-pages.edit', $systemPage)
                ->with('success', 'Зміни успішно збережено');
        }

        return back()->with('error', 'Не вдалось зберегти дані');
    }

}
