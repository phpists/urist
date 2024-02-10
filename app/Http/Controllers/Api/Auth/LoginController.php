<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Services\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LoginController extends BaseController
{

    public function index(LoginRequest $request)
    {
        $credentials = request(['phone', 'password']);

        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            return new JsonResponse([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = auth('api')->user();
        if (is_null($user->phone_verified_at)) {
            UserAuthService::resendVerificationCode($user, UserAuthService::RELATION_VERIFICATION_CODE);
            return new JsonResponse([
                'message' => Lang::get('messages.verify_phone'),
            ], 202);
        }

        return $this->respondWithToken($token);
    }

}
