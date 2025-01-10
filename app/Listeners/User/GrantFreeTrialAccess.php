<?php

namespace App\Listeners\User;

use App\Models\Plan\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use App\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GrantFreeTrialAccess
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
    public function handle($event): void
    {
        if ($event->freeTrial && $event->user->allSubscriptions()->count() === 0)
            Subscription::create([
                'plan_id' => Plan::first()->id,
                'user_id' => $event->user->id,
                'period' => 'trial',
                'price' => 0,
                'expires_at' => Carbon::now()->addDays(5)
            ]);
    }
}
