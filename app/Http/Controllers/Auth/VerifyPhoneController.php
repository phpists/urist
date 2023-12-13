<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserVerifyPhoneRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;


class VerifyPhoneController extends Controller
{

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('auth.verify_phone');
    }


    /**
     * @param UserVerifyPhoneRequest $request
     * @return RedirectResponse|void
     */
    public function verify(UserVerifyPhoneRequest $request)
    {

        DB::beginTransaction();
        try {
            $user = User::where('phone', $request->phone)->first();
            $code = $user?->userPhoneVerifyCodes()->where('code', $request->code)->first();

            if (!$code) {
                return back()->withErrors([
                    'code' => Lang::get('messages.invalid_code'),
                ])->onlyInput('phone');
            }
            $user->phone_verified_at = now();
            $user->save();
            $user->userPhoneVerifyCodes()->delete();
            DB::commit();
            return redirect()->route('login')
                ->with('success', Lang::get('messages.verify_success'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            abort(500);
        }
    }
}
