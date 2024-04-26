<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\User;
use App\Services\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

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

    public function handleProviderLogin(Request $request, string $provider, string $token)
    {
        try {
            $user = Socialite::driver($provider)->getUserFromToken($token);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return new JsonResponse([
                'result' => false,
                'message' => 'Помилка'
            ]);
        }

        $existing_user = User::where('email', $user->email)->first();
        if($existing_user){
            return $this->respondWithToken(\Auth::guard('api')->login($existing_user));
        } else {
            $column = $provider . '_id';

            $new_user = new User;
            $new_user->first_name = explode(' ', $user->name)[0] ?? "User";
            $new_user->last_name = explode(' ', $user->name)[1] ?? "";
            $new_user->email = $user->email;
            $new_user->$column = $user->id;
            $new_user->password = Hash::make(Str::random(8));
            $new_user->save();

            event(new UserRegisteredEvent($new_user));

            return $this->respondWithToken(\Auth::guard('api')->login($new_user));
        }
    }

}
