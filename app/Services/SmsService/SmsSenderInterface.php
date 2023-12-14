<?php

namespace App\Services\SmsService;

interface SmsSenderInterface
{
    public function sendMessage(array $phones, string $message): void;

}
