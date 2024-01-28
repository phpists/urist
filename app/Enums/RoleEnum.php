<?php

namespace App\Enums;

enum RoleEnum: string
{

    case ADMIN = 'admin';
    case SLAVE = 'slave';
    case LITE = 'lite';
    case BASE = 'base';
    case MAX = 'max';

}
