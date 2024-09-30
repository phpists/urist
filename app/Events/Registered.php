<?php

namespace App\Events;

class Registered extends \Illuminate\Auth\Events\Registered
{
    public function __construct(public $user, public bool $freeTrial = true)
    {
    }
}
