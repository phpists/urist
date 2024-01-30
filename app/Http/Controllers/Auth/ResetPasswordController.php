<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserSendResetPasswordCodeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserResetPasswordRequest;
use App\Http\Requests\UserSendForgotPasswordRequest;
use App\Http\Requests\VerifyPasswordResetCodeRequest;
use App\Jobs\SendVerificationCodeJob;
use App\Models\User;
use App\Models\UserResetPasswordCode;
use App\Services\SmsService\TurboSmsSender;
use App\Services\UserAuthService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        session([
            'hasSentCode' => 1,
            'phone' => $phone
        ]);

        return redirect()->route('password.verify-page')->with('message', trans('messages.verify_phone'));
    }

    public function verificationPage(Request $request): View|\Illuminate\Foundation\Application|Factory|Application|RedirectResponse
    {
        if (!$request->session()->has('hasSentCode')) {
            return redirect()->route('password.forgot');
        }
        return \view('auth.verify_reset');
    }

    public function verifyCode(VerifyPasswordResetCodeRequest $request) {
        $code = UserResetPasswordCode::query()->where('code', $request->code)->first();
        if (!$code) {
            $action_route = route('password.verify-code');
            return redirect()->back()->withErrors(['code' => trans('messages.invalid_code')])->withInput();
        }
        $user_id = $code->user_id;
        return \view('auth.reset_password', compact('user_id'));
    }

    public function resendVerifyCode(Request $request)
    {
        $user = User::wherePhone($request->post('phone'))->firstOrFail();

        UserAuthService::resendResetPasswordCode($user, UserAuthService::RELATION_PASSWORD_RESET_CODE);

        return new JsonResponse([
            'result' => true
        ]);
    }

    /**
     * @param UserResetPasswordRequest $request
     * @return \Illuminate\Foundation\Application|View|Factory|Application|RedirectResponse
     */
    public function resetPassword(UserResetPasswordRequest $request): \Illuminate\Foundation\Application|View|Factory|Application|RedirectResponse
    {
        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        $user->userResetPasswordVerifyCodes()->delete();
        $request->session()->forget('hasSentCode');
        return view('auth.login');

    }

}
