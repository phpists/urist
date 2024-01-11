<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        return view('user.profile.index', [
            'user' => \Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        \Auth::user()->update($request->all());

        return to_route('user.profile.index');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'confirmed']
        ]);

        if (!\Hash::check($request->post('old_password'), \Auth::user()->password))
            return back()->with('error', 'Неправильний пароль');

        \Auth::user()->update([
            'password' => \Hash::make($request->post('new_password'))
        ]);

        return back()->with('success', 'Пароль змінено');
    }

}
