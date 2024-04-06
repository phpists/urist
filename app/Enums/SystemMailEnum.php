<?php

namespace App\Enums;

use App\Models\SystemMail;

enum SystemMailEnum: string
{

    case SUBSCRIPTION_EXPIRED = 'subscription-expired';


    function getSystemMail(): SystemMail
    {
        return SystemMail::whereName($this->value)->firstOrFail();
    }

}
