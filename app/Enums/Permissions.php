<?php

namespace App\Enums;

enum Permissions: string
{
    case COPY_PAGE = 'copy_page';

    case EXPORT_PAGE = 'export_page';

    case CREATE_FAVOURITES = 'create_favourites';

    case POINT_TEXT = 'point_text';

    case FILE_CREATE = 'file_create';

    case INTELLECTUAL_SEARCH = 'intellectual_search';

    case ACCESS_TO_ARTICLES = 'access_to_articles';
}
