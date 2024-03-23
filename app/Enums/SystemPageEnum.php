<?php

namespace App\Enums;

use App\Models\SystemPage;

enum SystemPageEnum:string
{

    case HOME = 'home';
    case DASHBOARD = 'dashboard';

    case FAQ = 'faq';

    case CONTACTS = 'contacts';

    case ARTICLES = 'articles';

    public function getPage(): SystemPage
    {
        return SystemPage::whereName($this->value)->first();
    }

}
