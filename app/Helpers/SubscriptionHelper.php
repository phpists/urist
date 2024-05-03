<?php

namespace App\Helpers;

use App\Enums\SettingEnum;
use App\Services\SettingService;
use Illuminate\Support\Str;

class SubscriptionHelper
{

    static function getVariableTitle(SettingEnum $settingEnum): string
    {
        $value = explode('|', SettingService::getValueByName($settingEnum->value))[0] ?? '';
        $variables = self::getVariables();

        return Str::replace(
            array_keys($variables),
            array_values($variables),
            $value
        );
    }

    static function getVariableSubTitle(SettingEnum $settingEnum): string
    {
        $value = explode('|', SettingService::getValueByName($settingEnum->value))[1] ?? '';
        $variables = self::getVariables();

        return Str::replace(
            array_keys($variables),
            array_values($variables),
            $value
        );
    }

    private static function getVariables(): array
    {
        $user = \Auth::user();

        return [
            '{activePricePeriod}' => $user->activeSubscription->plan?->getPriceWithPeriodByPeriod($user->activeSubscription->period),
            '{activeExpiresAt}' => $user->activeSubscription->expires_at->format('d.m.Y'),
            '{pendingExpiresAt}' => $user->pendingSubscription->expires_at->format('d.m.Y')
        ];
    }

}
