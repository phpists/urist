<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('admin.auth.login');
    }

    public function register(Request $request) {
        $credentials = $request->validate([
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'phone' => 'string|required|unique:users',
            'password' => 'required|string'
        ]);
        $user = new User($credentials);
        $user->save();
        Auth::attempt([
            'phone' => $credentials['phone'],
            'password' => $credentials['password']
        ]);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin.dashboard');
        }

        return back()->withErrors([
            'phone' => 'The provided credentials do not match our records.',
        ])->onlyInput('phone');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
