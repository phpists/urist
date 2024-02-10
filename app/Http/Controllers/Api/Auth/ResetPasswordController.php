<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\UserSendResetPasswordCodeEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResetPasswordRequestRequest;
use App\Http\Requests\Api\Auth\ResetPasswordUpdateRequest;
use App\Http\Requests\Api\Auth\ResetPasswordVerifyRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{

    public function request(ResetPasswordRequestRequest $request)
    {
        $phone = $request->post('phone');
        $user = User::wherePhone($phone)->first();
        event(new UserSendResetPasswordCodeEvent($user));

        return new JsonResponse([
            'message' => Lang::get('messages.verify_phone'),
        ], 202);
    }

    public function verify(ResetPasswordVerifyRequest $request)
    {
        try {
            $user = User::where('phone', $request->post('phone'))->first();
            $code = $user?->userResetPasswordVerifyCodes()->where('code', $request->post('code'))->first();

            if (!$code) {
                return new JsonResponse([
                    'message' => Lang::get('messages.invalid_code'),
                ], 400);
            }

            return new JsonResponse([
                'result' => true
            ]);
        } catch (\Exception $exception) {
            Log::error($exception);
            abort(500);
        }
    }

    public function update(ResetPasswordUpdateRequest $request)
    {
        $user = User::wherePhone($request->post('phone'))->firstOrFail();
        $user->password = Hash::make($request->post('password'));
        if ($user->save()) {
            $user->userResetPasswordVerifyCodes()->delete();
            return new JsonResponse([
                'result' => true
            ]);
        }

        return new JsonResponse([
            'result' => false,
            'message' => 'Внутрішня помилка - спробуйте ще раз'
        ], 500);
    }

}
