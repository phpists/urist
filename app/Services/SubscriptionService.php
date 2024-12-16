<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\SubscriptionSession;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

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
                'expires_at' => $endAt,
                'source' => $source,
                'provider' => $provider,
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
    final function cancel(SubscriptionSession $subscriptionSession, string $at = null): void
    {
        $subscriptionSession->subscription->cancelled_at = $at ?? Carbon::now();
        if (!$subscriptionSession->subscription->save())
            throw new Exception('Не вдалось скасувати підписку');
    }

    final function move(User $fromUser, User $toUser)
    {
        try {
            DB::beginTransaction();
            $subscription = $fromUser->lastRevenueSubscription;
            $subscription->update(['user_id' => $toUser->id]);
            $subscription->session->update(['user_id' => $toUser->id]);

            $fromUser->removeRole(RoleEnum::MAX->value);
            $toUser->assignRole(RoleEnum::MAX->value);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('ERROR on transfer: ' . $e->getMessage() . ' subId' . ($subscription->id ?? '-') . ' from' . $fromUser->id . ' to ' . $toUser->id);
        }
    }

}
