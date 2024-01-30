<?php

namespace App\Services;

use App\Jobs\SendVerificationCodeJob;
use App\Models\User;
use App\Services\SmsService\TurboSmsSender;
use Illuminate\Support\Facades\Lang;

class UserAuthService
{

    const RELATION_VERIFICATION_CODE=  'userPhoneVerifyCodes';
    const RELATION_PASSWORD_RESET_CODE = 'userResetPasswordVerifyCodes';


    static public function resendVerificationCode(User $user, string $relation, bool $redirect = false)
    {
        dispatch(new SendVerificationCodeJob($user, new TurboSmsSender(), $relation));

        if ($redirect) {
            return redirect()->route('verify_phone.page')
                ->with([
                    'success' => Lang::get('messages.verify_phone'),
                    'phone' => $user->phone
                ]);
        }
    }

    static public function resendResetPasswordCode(User $user, string $relation, bool $redirect = false)
    {
        dispatch(new SendVerificationCodeJob($user, new TurboSmsSender(), $relation));

        if ($redirect) {
            return redirect()->route('verify_phone.page')
                ->with([
                    'success' => Lang::get('messages.verify_phone'),
                    'phone' => $user->phone
                ]);
        }
    }

}
