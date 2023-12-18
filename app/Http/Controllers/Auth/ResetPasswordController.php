<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserSendResetPasswordCodeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserResetPasswordRequest;
use App\Http\Requests\UserSendForgotPasswordRequest;
use App\Models\User;
use App\Models\UserResetPasswordCode;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('auth.forgot_password');
    }


    /**
     * @param UserSendForgotPasswordRequest $request
     * @return \Illuminate\Foundation\Application|View|Factory|Application|RedirectResponse
     */
    public function sendResetPasswordCode(UserSendForgotPasswordRequest $request): \Illuminate\Foundation\Application|View|Factory|Application|RedirectResponse
    {
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['phone' => trans('messages.user_not_found')])->withInput();
        }
        event(new UserSendResetPasswordCodeEvent($user));
        return to_route('password.reset')->with('message', trans('messages.verify_phone'));
    }

    /**
     * @param UserResetPasswordRequest $request
     * @return \Illuminate\Foundation\Application|View|Factory|Application|RedirectResponse
     */
    public function resetPassword(UserResetPasswordRequest $request): \Illuminate\Foundation\Application|View|Factory|Application|RedirectResponse
    {
        $code = UserResetPasswordCode::where('code', $request->code)->first();
        if (!$code) {
            return redirect()->back()->withErrors(['code' => trans('messages.invalid_code')])->withInput();
        }
        $user = User::find($code->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        $user->userResetPasswordVerifyCodes()->delete();
        return view('auth.login');

    }

}
