<?php

namespace App\Http\Resources\Api;

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
            $userArr['premium_type'] = match ($this->activeSubscription->period) {
                'year' => 'base_annual',
                'month' => 'base_monthly',
            };
            $userArr['premium_source'] = $this->activeSubscription->source;
            $userArr['premium_expiration'] = $this->activeSubscription->expires_at;
        }

        return $userArr;
    }
}
