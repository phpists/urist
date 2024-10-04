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
        $userArr['is_premium'] = (bool) $request->activeSubscription;

        if ($userArr['is_premium']) {
            $userArr['premium_type'] = match ($request->activeSubscription->period) {
                'year' => 'base_annual',
                'month' => 'base_monthly',
            };
            $userArr['premium_source'] = $request->activeSubscription->source;
            $userArr['premium_expiration'] = $request->activeSubscription->expires_at;
        }

        return $userArr;
    }
}
