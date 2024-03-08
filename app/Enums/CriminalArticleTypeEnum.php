<?php

namespace App\Enums;

enum CriminalArticleTypeEnum: string
{

    case KK = 'kk';
    case KPK = 'kpk';

    public function getTitle(): string
    {
        return match ($this->value) {
            self::KPK->value => 'КПК',
            self::KK->value => 'КК',
        };
    }

}
