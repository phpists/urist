<?php

namespace App\Listeners;

use App\Events\UserSendResetPasswordCodeEvent;
use App\Services\SmsService\TurboSmsSender;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Lang;

class UserSendVerifyCodeResetPasswordListener implements ShouldQueue
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
    public function handle(UserSendResetPasswordCodeEvent $event): void
    {
        $event->user->userResetPasswordVerifyCodes()->delete();
        $code = rand(1000, 9999);
        $message = Lang::get('messages.sms_code_sent_reset_password') . ': ' . $code;
        $event->user->userResetPasswordVerifyCodes()->create(['code' => $code]);
        $this->sender->sendMessage([$event->user->phone], $message);
    }
}
