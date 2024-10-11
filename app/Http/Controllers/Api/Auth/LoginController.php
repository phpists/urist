<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\GuestLoginRequest;
use App\Models\User;
use App\Services\UserAuthService;
use Google_Client;
use App\Events\Registered;
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

        $user->updateQuietly(['current_api_token' => $token]);

        return $this->respondWithToken($token);
    }

    public function guest(GuestLoginRequest $request)
    {
        $credentials = $request->validated();
        if (!Str::contains($credentials['username'], '@'))
            $credentials['username'] = $credentials['username'] . '@test.lexgo.com.ua';

        $user = User::firstWhere('email', $credentials['username']);
        if (!$user) {
            $user = User::create([
                'first_name' => $credentials['username'],
                'last_name' => $credentials['username'],
                'email' => $credentials['username'],
                'password' => Hash::make($credentials['password']),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ]);

            $token = \Auth::guard('api')->login($user);
        } else {
            $token = \Auth::guard('api')->attempt([
                'email' => $credentials['username'],
                'password' => $credentials['password'],
            ]);
        }

        return $this->respondWithToken($token);
    }

    public function handleAppleLogin(Request $request, string $token)
    {
        try {
            $user = Socialite::driver('apple')->userByIdentityToken($token);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return new JsonResponse([
                'result' => false,
                'message' => 'Помилка'
            ]);
        }

        return $this->getSocialiteResponse($user, 'apple');
    }


    public function handleGoogleLogin(\Request $request, string $token)
    {
        try {
            $client = new Google_Client(['client_id' => env('GOOGLE_API_CLIENT_ID')]);
            $payload = $client->verifyIdToken($token);

            if ($payload) {
                $user = (object) [
                    'id' => $payload['sub'],
                    'email' => $payload['email'],
                    'name' => ($payload['given_name'] ?? null) . ' ' . ($payload['family_name'] ?? null),
                ];
            } else {
                throw new \Exception('ERROR! Can\'t get data from token');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return new JsonResponse([
                'result' => false,
                'message' => 'Помилка'
            ]);
        }

        return $this->getSocialiteResponse($user, 'google');
    }

    private function getSocialiteResponse($user, $provider)
    {
        $existing_user = User::where('email', $user->email)->first();
        if($existing_user){
            $token = \Auth::guard('api')->login($existing_user);
            $existing_user->updateQuietly(['current_api_token' => $token]);

            return $this->respondWithToken($token);
        } else {
            $column = $provider . '_id';

            $new_user = new User;
            $new_user->first_name = explode(' ', $user->name)[0] ?? "User";
            $new_user->last_name = explode(' ', $user->name)[1] ?? "";
            $new_user->email = $user->email;
            $new_user->$column = $user->id;
            $new_user->password = Hash::make(Str::random(8));
            $new_user->save();

            event(new Registered($new_user, false));

            $token = \Auth::guard('api')->login($new_user);
            $new_user->updateQuietly(['current_api_token' => $token]);

            return $this->respondWithToken($token);
        }
    }

}
