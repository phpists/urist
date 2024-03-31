<?php

namespace App\Enums;

use App\Models\ArticleCategory;

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

    public function getCategory(): ?ArticleCategory
    {
        return ArticleCategory::whereName($this->getTitle())->first();
    }

}
