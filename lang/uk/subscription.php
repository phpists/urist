<?php

use App\Enums\Permissions;

return [
    Permissions::INTELLECTUAL_SEARCH->value => 'Інтелектуальний пошук',
    Permissions::COPY_PAGE->value => 'Можливість копіювати сторінку',
    Permissions::ACCESS_TO_ARTICLES->value => 'Доступна база правових позицій',
    Permissions::CREATE_FAVOURITES->value => 'Можливість створювати закладки по рішенням в особистому кабінеті',
    Permissions::EXPORT_PAGE->value => 'Можливість скачувати сторінку кнопкою export',
    Permissions::FILE_CREATE->value => 'Можливість самостійно створювати свої особисті сторінки з рішеннями, просвоювати імена рішенням з прив’язкою до посилання і т.п.',
    Permissions::POINT_TEXT->value => 'Можливість відмічати жовтим кольором потрібне',
    'roles' => [
        \App\Models\User::ROLE_BASE => 'Base',
        \App\Models\User::ROLE_LITE => 'Lite'
    ],
    'month' => 'Місяць',
    'year' => 'Рік',
    'day' => 'День',
    'trial' => 'Пробний період',
];
