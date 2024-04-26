<?php

namespace App\Enums;

enum SettingEnum: string
{

    case ADMIN_EMAIL = 'admin_email';
    case CRIMINAL_ARTICLES_PER_PAGE = 'criminal_articles_per_page';

    case KPK_MODULE_BTN = 'kpk_module_btn';
    case KK_MODULE_BTN = 'kk_module_btn';

    case APPLE_STORE_URL = 'apple_store_url';
    case GOOGLE_STORE_URL = 'google_store_url';
    case FOOTER_TEXT = 'footer_text';

}
