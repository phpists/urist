<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\Session;
use App\Models\User;
use App\Services\Apple\AppleToken;
use App\Services\UserAuthService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('auth.login');
    }

    /**
     * @param UserLoginRequest $request
     * @return Factory|View|\Illuminate\Foundation\Application|RedirectResponse|Application
     */
    public function login(UserLoginRequest $request): Factory|View|\Illuminate\Foundation\Application|RedirectResponse|Application
    {
        $credentials = $request->only('phone', 'password');
        $remember = isset($request->checkboxKeep);
        if (auth()->attempt($credentials, $remember)) {
            $user = auth()->user();
            if (!is_null($user->phone_verified_at)) {
                Session::whereUserId($user->id)
                    ->whereNot('id', \Session::getId())
                    ->delete();

                return to_route('user.dashboard.index');
            }
            auth()->logout();
            return UserAuthService::resendVerificationCode($user, UserAuthService::RELATION_VERIFICATION_CODE, true);
        }
        return back()->withErrors(['phone' => Lang::get('messages.invalid_data_login')])->withInput();
    }

    /**
     * @throws GuzzleException
     */
    public function send(): void
    {
        try {
            $client = new Client();
            $response = $client->post(config('services.turbo_sms.url'), [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('services.turbo_sms.token'),
                    'Content-Type' => 'application/json',
                ],
                "json" => [
                    'recipients' => [
                        "380932439328",
                    ],
                    'sms' => [
                        'sender' => config('services.turbo_sms.sender_sms'),
                        'text' => config('services.turbo_sms.sender') . ' - ' . 'TurboSMS приветствует Вас!'
                    ],
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);
            Log::info("Turbo sms :" . $responseData['response_code'] . ' ' . $responseData['response_status']);
        } catch (\Exception $e) {
            Log::info("An error with turbo sms service : " . $e->getMessage());
        }
    }

    public function driverLogin(\Request $request, string $driver)
    {
        try {
            if ($driver == 'apple')
                \Config::set('services.apple.client_secret', (\App::make(AppleToken::class))->generate());

            return Socialite::driver($driver)->redirect();
        } catch (\Exception $e) {
            return back()->with('error', 'Помилка');
        }
    }

    public function handleDriverLoginCallback(\Request $request, string $driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/');
        }

        $existing_user = User::where('email', $user->email)->first();
        if($existing_user){
            auth()->login($existing_user, true);
        } else {
            $column = $driver . '_id';

            $new_user = new User;
            $new_user->first_name = explode(' ', $user->name)[0] ?? "User";
            $new_user->last_name = explode(' ', $user->name)[1] ?? "";
            $new_user->email = $user->email;
            $new_user->$column = $user->id;
            $new_user->password = Hash::make(Str::random(8));
            $new_user->save();

            event(new Registered($new_user));

            auth()->login($new_user, true);
        }

        return to_route('user.dashboard.index');
    }

}
