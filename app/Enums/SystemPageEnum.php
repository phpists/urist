<?php

namespace App\Enums;

use App\Models\SystemPage;

enum SystemPageEnum:string
{

    case HOME = 'home';
    case DASHBOARD = 'dashboard';

    public function getPage(): SystemPage
    {
        return SystemPage::whereName($this->value)->first();
    }

}
