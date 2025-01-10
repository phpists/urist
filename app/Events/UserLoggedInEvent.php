<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class UserLoggedInEvent
{
    use Dispatchable;

    public function __construct(public readonly User $user, public readonly bool $freeTrial = true)
    {
    }
}
