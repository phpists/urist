<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{

    public static function getSettingByName(string $name): ?Setting
    {
        return Setting::whereName($name)->first();
    }

    public static function getValueByName(string $name): ?string
    {
        return self::getSettingByName($name)?->value;
    }

}
