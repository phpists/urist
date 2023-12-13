<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('auth.login');
    }

    public function login(UserLoginRequest $request): Factory|View|\Illuminate\Foundation\Application|RedirectResponse|Application
    {
        $credentials = $request->only('phone', 'password');
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            if ($user->phone_verified_at) {
                return view('pages.dashboard');
            }
            auth()->logout();
            return back()->withErrors(['phone' => Lang::get('messages.not_verified')]);
        }
        return back()->withErrors(['phone' => Lang::get('messages.invalid_data_login')]);
    }
}
