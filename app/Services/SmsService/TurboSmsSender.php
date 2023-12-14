<?php

namespace App\Services\SmsService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class TurboSmsSender implements SmsSenderInterface
{

    /**
     * @param array $phones
     * @param string $message
     * @return void
     * @throws GuzzleException
     */
    public function sendMessage(array $phones, string $message): void
    {
        try {
            $client = new Client();
            $response = $client->post(config('services.turbo_sms.url'), [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('services.turbo_sms.token'),
                    'Content-Type' => 'application/json',
                ],
                "json" => [
                    'recipients' => $phones,
                    'sms' => [
                        'sender' => config('services.turbo_sms.sender_sms'),
                        'text' => config('services.turbo_sms.sender') . ' - ' . $message
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
