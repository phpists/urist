<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $userArr = parent::toArray($request);
        $userArr['is_premium'] = (bool) $request->resource->activeSubscription;

        if ($userArr['is_premium']) {
            $userArr['premium_type'] = match ($request->resource->activeSubscription->period) {
                'year' => 'base_annual',
                'month' => 'base_monthly',
            };
            $userArr['premium_source'] = $request->resource->activeSubscription->source;
            $userArr['premium_expiration'] = $request->resource->activeSubscription->expires_at;
        }

        return $userArr;
    }
}
