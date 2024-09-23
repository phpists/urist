<?php

namespace App\Services;

use App\Models\User;
use App\Models\WelcomeHint;

class WelcomeHintService
{

    static public function getUserPendingWelcomeHints(User $user)
    {
        return WelcomeHint::whereNotIn('id', $user->welcomeHints()->pluck('id'))->get();
    }

}
