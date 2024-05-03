<?php

namespace App\Listeners\User;

use App\Enums\RoleEnum;
use App\Events\UserSubscriptionExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveRole
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
        \Log::error($event->user->hasRole([RoleEnum::MAX->value]) ? '111' : '000');
        \Log::error(json_encode($event->user->roles()));
        if ($event->user->hasRole([RoleEnum::MAX->value]))
            $event->user->removeRole(RoleEnum::MAX->value);
    }
}
