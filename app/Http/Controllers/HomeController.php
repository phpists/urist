<?php

namespace App\Http\Controllers;

use App\Enums\SettingEnum;
use App\Enums\SystemPageEnum;
use App\Mail\FeedbackFormMail;
use App\Models\Plan\Feature;
use App\Models\Plan\Plan;
use App\Services\SettingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        return view('home', [
            'systemPage' => SystemPageEnum::HOME->getPage(),
            'plans' => Plan::active()->orderBy('pos')->get(),
            'features' => Feature::active()->orderBy('pos')->get()
        ]);
    }

    public function policy()
    {
        return view('pages.policy', [
            'systemPage' => SystemPageEnum::POLICY->getPage()
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'systemPage' => SystemPageEnum::ABOUT->getPage()
        ]);
    }

    public function offer()
    {
        return view('pages.offer', [
            'systemPage' => SystemPageEnum::OFFER->getPage()
        ]);
    }

    public function form(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'message' => ['required'],
        ]);

        try {
            $email = SettingService::getValueByName(SettingEnum::ADMIN_EMAIL->value) ?? config('app.admin_email');
            Mail::to($email)
                ->send(
                    new FeedbackFormMail(
                        $request->post('name'),
                        $request->post('email'),
                        $request->post('message')
                    )
                );

            return new JsonResponse([
                'result' => true
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'result' => false
            ]);
        }
    }

}
