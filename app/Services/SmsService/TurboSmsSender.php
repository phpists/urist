<?php

namespace App\Services\SmsService;

use Illuminate\Support\Facades\Log;

class TurboSmsSender implements SmsSenderInterface
{

    public function sendVerifyCode(array $phones, string $message): mixed
    {
        return Log::info($message . $phones[0]);
    }
}
