<?php

namespace App\Services\SmsService;

interface SmsSenderInterface
{
    public function sendVerifyCode(array $phones, string $message): mixed;

}
