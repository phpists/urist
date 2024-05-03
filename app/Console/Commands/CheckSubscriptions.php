<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Events\UserSubscriptionExpired;
use App\Models\User;
use Illuminate\Console\Command;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check subscription for expiration and takes away rights';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usersWithSubscription = User::whereHas('activeSubscription')->get();

        echo 'found ' . $usersWithSubscription->count() . ' users' . PHP_EOL;

        foreach ($usersWithSubscription as $user) {
            echo "\tuser " . $user->email . ': ' . PHP_EOL;
            echo 'check #1: ' . ($user->activeSubscription->isCancelled() && $user->activeSubscription->expires_at->isPast()) . PHP_EOL;
            echo 'check #2: ' . ($user->activeSubscription->expires_at->addHours(6)->isPast()) . PHP_EOL . PHP_EOL;
            if (($user->activeSubscription->isCancelled() && $user->activeSubscription->expires_at->isPast())
                || $user->activeSubscription->expires_at->addHours(6)->isPast())
                UserSubscriptionExpired::dispatch($user);
        }
    }
}
