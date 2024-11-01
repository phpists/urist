<?php

namespace App\Enums;

enum MobilePeriodEnum: string
{
    case MONTH = 'base_monthly';
    case YEAR = 'base_annual';

    public function getDefaultValue(): string
    {
        return match ($this) {
            self::MONTH => 'month',
            self::YEAR => 'year',
        };
    }

    static public function fromDefaultValue(string $value): self
    {
        return match ($value) {
            'month' => self::MONTH,
            'year' => self::YEAR,
        };
    }
}
