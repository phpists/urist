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
    case DEFAULT_FOLDERS = 'default_folders';
    case SUBSCRIPTION_TEXT_FREE_TRIAL = 'subscription_text_free_trial';
    case SUBSCRIPTION_TEXT_FREE = 'subscription_text_free';
    case SUBSCRIPTION_TEXT_CANCELLED = 'subscription_text_cancelled';
    case SUBSCRIPTION_TEXT_ACTIVE = 'subscription_text_active';
    case SUBSCRIPTION_TEXT_PENDING = 'subscription_text_pending';
    case SUBSCRIPTION_TEXT_MISSING = 'subscription_text_missing';
    case FACEBOOK_URL = 'facebook_url';
    case SHARE_URL = 'share_url';
    case SHARE_TEXT = 'share_text';

}
