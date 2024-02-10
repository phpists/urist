<?php

namespace App\Http\Controllers\Api\Auth;


use App\Enums\RoleEnum;
use App\Events\UserRegisteredEvent;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use App\Services\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class RegisterController extends BaseController
{

    public function index(RegisterRequest $request)
    {
        try {
            $user = User::where('phone', $request->post('phone'))->first();
            if ($user && is_null($user->phone_verified_at)) {
                UserAuthService::resendVerificationCode($user, UserAuthService::RELATION_VERIFICATION_CODE);
                return new JsonResponse([
                    'message' => 'Підтвердьте ваш номер телефону, ми надіслали код',
                ], 202);
            }

            DB::beginTransaction();

            $newUser = User::create([
                'first_name' => $request->post('name'),
                'phone' => $request->post('phone'),
                'password' => Hash::make($request->post('password')),
            ]);
            $newUser->assignRole(RoleEnum::SLAVE);

            DB::commit();

            event(new UserRegisteredEvent($newUser));

            return new JsonResponse([
                'message' => Lang::get('messages.verify_phone'),
            ], 202);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            abort(500);
        }
    }

}
