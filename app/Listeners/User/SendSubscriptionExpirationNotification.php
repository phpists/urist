<?php

namespace App\Listeners\User;

use App\Events\UserSubscriptionExpired;
use App\Notifications\SubscriptionExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSubscriptionExpirationNotification
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSubscriptionExpired $event): void
    {
        if ($event->shouldSendNotification)
            $event->user->notify(new SubscriptionExpired());
    }

}
