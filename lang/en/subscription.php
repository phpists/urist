<?php

use App\Enums\Permissions;

return [
    Permissions::INTELLECTUAL_SEARCH->value => 'Intellectual search',
    Permissions::COPY_PAGE->value => 'Possibility to copy page',
    Permissions::ACCESS_TO_ARTICLES->value => 'Ability to create your own personal pages with decisions, enlighten names with a link to reference, etc.',
    Permissions::CREATE_FAVOURITES->value => 'Ability to create bookmarks by decision in a personal office',
    Permissions::EXPORT_PAGE->value => 'Ability to download an Export button',
    Permissions::FILE_CREATE->value => 'Ability to create your own personal pages with decisions, enlighten names with a link to reference, etc.',
    Permissions::POINT_TEXT->value => 'The ability to mark yellow color is needed'
];
