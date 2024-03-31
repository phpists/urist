<?php

namespace App\Enums;

enum RoleEnum: string
{

    case ADMIN = 'admin';
    case SLAVE = 'slave';
    case MAX = 'max';

}
