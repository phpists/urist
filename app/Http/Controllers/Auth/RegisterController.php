<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('auth.register');
    }

    /**
     * @param UserRegisterRequest $request
     * @return RedirectResponse|void
     */
    public function register(UserRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $ifUserPhoneNotVerified = User::where('phone',$request->phone)->first();
            if ($ifUserPhoneNotVerified->phone_verified_at){
                return redirect()->back()->withErrors(['phone'=> trans('validation.custom.phone.unique')])->withInput();
            }
            if (!$ifUserPhoneNotVerified->phone_verified_at){
                return redirect()->back()->withErrors(['phone'=> trans('messages.not_verified')])->withInput();
            }


            $newUser = User::create([
                'first_name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            $newUser->assignRole(User::ROLE_USER);
            DB::commit();
            event(new UserRegisteredEvent($newUser));
            return redirect()->route('verify_phone.page')
                ->with([
                    'success' => Lang::get('messages.verify_phone'),
                    'phone' => $newUser->phone
                ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            abort(500);
        }
    }
}
