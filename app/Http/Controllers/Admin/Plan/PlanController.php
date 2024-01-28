<?php

namespace App\Http\Controllers\Admin\Plan;

use App\Http\Controllers\Controller;
use App\Models\Plan\Feature;
use App\Models\Plan\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function index()
    {
        return view('admin.plans.plans.index', [
            'plans' => Plan::orderBy('pos')->get(),
            'features' => Feature::orderBy('pos')->get()
        ]);
    }

    public function sort(Request $request)
    {
        $positions = $request->post('positions');

        if ($positions) {
            foreach ($positions as $position) {
                $model = Plan::findOrFail($position['id']);
                $model->pos = $position['pos'];
                $model->save();
            }
        }
    }

    public function show(Request $request, Plan $plan)
    {
        return $plan->load(['features']);
    }

    public function update(Request $request, Plan $plan)
    {
        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        $result = $plan->update($data);
        if ($request->has('features')) {
            $permissionsToSync = [];
            $plan->planFeatures()->delete();
            foreach ($request->post('features') as $feature_id) {
                $feature = Feature::find($feature_id);
                $plan->planFeatures()->create(['feature_id' => $feature->id]);
                $permissionsToSync[] = $feature->permission->name;
            }
            $plan->role->syncPermissions($permissionsToSync);
        }

        if ($request->wantsJson())
            return new JsonResponse([
                'result' => $result
            ]);

        if ($result)
            return back()->with('success', 'План успішно оновлено');
        else
            return back()->with('error', 'Не вдалось зберегти зміни');
    }

}
