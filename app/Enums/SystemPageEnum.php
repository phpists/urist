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
    case ABOUT = 'about';

    case USER_PROFILE = 'user_profile';
    case USER_CABINET = 'user_cabinet';
    case USER_REGISTRIES = 'user_registries';
    case USER_SUBSCRIPTION = 'user_subscription';


    public function getPage(): SystemPage
    {
        return SystemPage::whereName($this->value)->firstOrFail();
    }

}
