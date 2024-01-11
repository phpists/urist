<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

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
            if ($user->phone_verified_at) {
                return to_route('user.dashboard.index');
            }
            auth()->logout();
            return back()->withErrors(['phone' => Lang::get('messages.not_verified')])->withInput();
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
}
