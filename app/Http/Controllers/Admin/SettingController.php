<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        return view('admin.settings.index', [
            'settings' => Setting::all()
        ]);
    }

    public function show(Request $request, Setting $setting)
    {
        return $setting;
    }

    public function update(Request $request, Setting $setting)
    {
        $value = $request->post('value');

        if ($setting->update(['value' => $value]))
            return to_route('admin.settings.index')->with('success', 'Дані успішно збережено');

        return back()->with('error', 'Не вдалось зберегти дані');
    }

}
