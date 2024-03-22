<?php

namespace App\Enums;

enum PermissionEnum: string
{

    case SMART_SEARCH = 'smart_search';
    case LEGAL_BASE = 'legal_base';
    case EXPORT_PAGE = 'export_page';
    case CREATE_BOOKMARKS = 'create_bookmarks';
    case MARK_NEEDED = 'mark_needed';
    case CREATE_OWN_PAGES = 'create_own_pages';
    case COPY_PAGE = 'copy_page';
    case MODULE_KPK = 'module_kpk';
    case MODULE_KK = 'module_kk';

}
