<?php

namespace App\Enums;

enum MobilePeriodEnum: string
{
    case MONTH = 'base_monthly';
    case ANDROID_MONTH = 'base_monthly:base-monthly';
    case YEAR = 'base_annual';
    case ANDROID_YEAR = 'base_annual:base-annual';
    case TRIAL = 'trial';

    public function getDefaultValue(): string
    {
        return match ($this) {
            self::MONTH, self::ANDROID_MONTH => 'month',
            self::YEAR, self::ANDROID_YEAR => 'year',
            self::TRIAL => 'trial',
        };
    }

    static public function fromDefaultValue(string $value): self
    {
        return match ($value) {
            'month' => self::MONTH,
            'year' => self::YEAR,
            'trial' => self::TRIAL,
        };
    }
}
