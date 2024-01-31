<?php

namespace App\Http\Controllers;

use App\Enums\SettingEnum;
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
            'plans' => Plan::active()->orderBy('pos')->get(),
            'features' => Feature::active()->orderBy('pos')->get()
        ]);
    }

    public function form(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'message' => ['required'],
        ]);

        $email = SettingService::getValueByName(SettingEnum::ADMIN_EMAIL->value) ?? config('app.admin_email');

        return new JsonResponse([
            'result' => Mail::to($email)
                ->send(
                    new FeedbackFormMail(
                        $request->post('name'),
                        $request->post('email'),
                        $request->post('message')
                    )
                )
        ]);
    }

}
