<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Services\SmsService\TurboSmsSender;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Lang;

class UserSendVerifyCodeListener implements ShouldQueue
{
    use InteractsWithQueue;

    private TurboSmsSender $sender;

    /**
     * Create the event listener.
     */
    public function __construct(TurboSmsSender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): void
    {
        $code = rand(1000, 9999);
        $message = Lang::get('messages.sms_code_sent: ') . $code;
        $event->user->userPhoneVerifyCodes()->create(['code' => $code]);
        $phoneNumber = [$event->user->phone];
        $this->sender->sendVerifyCode($phoneNumber, $message);
    }
}
