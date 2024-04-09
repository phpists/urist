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
    case BLOG = 'blog';
    case POLICY = 'policy';
    case OFFER = 'offer';


    public function getPage(): SystemPage
    {
        return SystemPage::whereName($this->value)->firstOrFail();
    }

}
