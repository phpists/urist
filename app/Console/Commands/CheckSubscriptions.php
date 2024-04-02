<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
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

        foreach ($usersWithSubscription as $user) {
            if ($user->activeSubscription->isCancelled() && $user->activeSubscription->expires_at->isPast()) {
                if ($user->hasRole([RoleEnum::MAX->value]))
                    $user->removeRole(RoleEnum::MAX->value);
            }
        }
    }
}
