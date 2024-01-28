<?php

namespace App\Http\Controllers\Admin\Plan;

use App\Http\Controllers\Controller;
use App\Models\Plan\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeatureController extends Controller
{

    public function index()
    {
        return view('admin.plans.features.index', [
            'features' => Feature::orderBy('pos')->get()
        ]);
    }

    public function sort(Request $request)
    {
        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {
                $model = Feature::findOrFail($position['id']);
                $model->pos = $position['pos'];
                $model->save();
            }
        }
    }

    public function show(Request $request, Feature $feature)
    {
        return $feature;
    }

    public function update(Request $request, Feature $feature)
    {
        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        $result = $feature->update($data);

        if ($request->wantsJson())
            return new JsonResponse([
                'result' => $result
            ]);

        if ($result)
            return back()->with('success', 'Можливість успішно оновлено');
        else
            return back()->with('error', 'Не вдалось зберегти зміни');
    }

}
