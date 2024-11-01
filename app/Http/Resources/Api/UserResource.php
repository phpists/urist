<?php

namespace App\Http\Resources\Api;

use App\Enums\MobilePeriodEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        $userArr = parent::toArray($request);
        $userArr['is_premium'] = $this->activeSubscription()->exists();

        if ($userArr['is_premium']) {
            $userArr['premium_type'] = MobilePeriodEnum::fromDefaultValue($this->activeSubscription->period)->value;
            $userArr['premium_source'] = $this->activeSubscription->source;
            $userArr['premium_expiration'] = $this->activeSubscription->expires_at;
        }

        return $userArr;
    }
}
