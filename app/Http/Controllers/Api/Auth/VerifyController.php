<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\VerifyCodeRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class VerifyController extends BaseController
{

    public function index(VerifyCodeRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('phone', $request->post('phone'))->first();
            $code = $user?->userPhoneVerifyCodes()->where('code', $request->post('code'))->first();

            if (!$code) {
                return new JsonResponse([
                    'message' => Lang::get('messages.invalid_code'),
                ], 400);
            }

            $user->phone_verified_at = now();
            $user->save();
            $user->userPhoneVerifyCodes()->delete();
            DB::commit();

            $token = Auth::guard('api')->login($user);
            return $this->respondWithToken($token);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            abort(500);
        }
    }

}
