<?php

namespace App\Services;

use App\Models\SubscriptionSession;
use Carbon\Carbon;
use Exception;

class SubscriptionService
{

    final function create(SubscriptionSession $subscriptionSession, array $payload, string $startsAt, string|int $amount, string $source, string $provider): void
    {
        $addPeriod = 'add' . ucfirst($subscriptionSession->period);

        if ($subscriptionSession->user->activeSubscription) {
            $endAt = $subscriptionSession->user->activeSubscription->expires_at;
        } else {
            $endAt = Carbon::createFromTimestamp(substr($startsAt, 0, -3));
        }

        $endAt = Carbon::parse($endAt)
            ->$addPeriod()
            ->format('Y-m-d');

        if (!$subscriptionSession->subscription) {
            $subscription = $subscriptionSession->subscription()->create([
                'plan_id' => $subscriptionSession->plan_id,
                'user_id' => $subscriptionSession->user_id,
                'period' => $subscriptionSession->period,
                'price' => $amount,
                'expires_at' => $endAt
            ]);

            $subscriptionPayment = $subscription->payments()->create([
                'amount' => $amount,
                'end_at' => $endAt,
                'payload' => $payload,
            ]);

            $subscription->user->assignRole($subscription->plan->role);
        }
    }

    final function continue(SubscriptionSession $subscriptionSession, array $payload, string $startsAt, string|int $amount): void
    {
        $addPeriod = 'add' . ucfirst($subscriptionSession->period);
        $endAt = Carbon::createFromTimestamp(substr($startsAt, 0, -3))
            ->$addPeriod()
            ->format('Y-m-d');

        $subscriptionSession->subscription->update([
            'expires_at' => $endAt
        ]);

        $subscriptionPayment = $subscriptionSession->subscription->payments()->create([
            'amount' => $amount,
            'end_at' => $endAt,
            'payload' => $payload,
        ]);
    }

    /**
     * @throws Exception
     */
    final function cancel(SubscriptionSession $subscriptionSession): void
    {
        $subscriptionSession->subscription->cancelled_at = Carbon::now();
        if (!$subscriptionSession->subscription->save())
            throw new Exception('Не вдалось скасувати підписку');
    }

}
