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
        return view('admin.system-pages.edit', [
            'model' => $systemPage
        ]);
    }

    public function update(Request $request, SystemPage $systemPage)
    {
        $systemPage->title = $request->post('title');
        $systemPage->data = $request->post('data');
        $images = $systemPage->images ?? [];

        foreach($request->allFiles() as $allFiles) {
            foreach ($allFiles as $i => $file) {
                if (Storage::put(SystemPage::IMG_PATH, $file)) {
                    if ($systemPage->getImageSrc($i))
                        Storage::delete(SystemPage::IMG_PATH . $systemPage->images[$i]);

                    $images[$i] = $file->hashName();
                }
            }
        }

        $systemPage->images = $images;

        if ($systemPage->save()) {
            return to_route('admin.system-pages.edit', $systemPage)
                ->with('success', 'Зміни успішно збережено');
        }

        return back()->with('error', 'Не вдалось зберегти дані');
    }

}
