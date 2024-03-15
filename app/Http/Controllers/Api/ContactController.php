<?php

namespace App\Http\Controllers\Api;

use App\Enums\SettingEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactFormRequest;
use App\Mail\FeedbackFormMail;
use App\Services\SettingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function form(ContactFormRequest $request)
    {
        $email = SettingService::getValueByName(SettingEnum::ADMIN_EMAIL->value) ?? config('app.admin_email');

        try {
            Mail::to($email)
                ->send(
                    new FeedbackFormMail(
                        $request->validated('name'),
                        $request->validated('email'),
                        $request->validated('message')
                    )
                );

            $result = true;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $result = false;
        }
        return new JsonResponse([
            'result' => $result,
            'message' => $result
                ? 'Форма успішно надіслана'
                : 'Не вдалось надіслати форму'
        ]);
    }

}
