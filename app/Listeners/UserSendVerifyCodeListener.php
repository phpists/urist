<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Jobs\SendVerificationCodeJob;
use App\Services\SmsService\TurboSmsSender;
use App\Services\UserAuthService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Lang;

class UserSendVerifyCodeListener
{

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
        dispatch(new SendVerificationCodeJob($event->user, $this->sender, UserAuthService::RELATION_VERIFICATION_CODE));
    }
}
