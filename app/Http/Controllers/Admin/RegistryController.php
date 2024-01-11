<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkDeleteItemsRequest;
use App\Models\CriminalArticle;
use App\Models\Registry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegistryController extends Controller
{

    public function index()
    {
        $registries = Registry::paginate()
            ->withQueryString();

        return view('admin.registries.index', compact('registries'));
    }

    public function store(Request $request)
    {
        if (Registry::create($request->only(['title', 'link']))) {
            return back()->with('success', 'Реєстр додано');
        }

        return back()->with('error', 'Не вдалось додати реєстр');
    }

    public function show(Request $request, Registry $registry)
    {
        if ($request->wantsJson())
            return $registry;

        return redirect('/admin');
    }

    public function update(Request $request, Registry $registry)
    {
        if ($registry->update($request->post())) {
            return back()->with('success', 'Реєстр оновлено');
        }

        return back()->with('error', 'Не вдалось оновити реєстр');
    }

    public function destroy(Request $request, Registry $registry)
    {
        if ($registry->delete()) {
            return back()->with('success', 'Реєстр видалено');
        }

        return back()->with('error', 'Не вдалось видалити реєстр');
    }

    public function bulkDelete(BulkDeleteItemsRequest $request)
    {
        $query = Registry::whereIn('id', $request->item_list);
        try {
            if ($query->delete())
                return response()->json(['success' => 'Записи успішно видалені']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return response()->json(['error' => 'Не вдалось видалити записи'], 500);
    }

}
