<?php

namespace App\Http\Controllers\Api;

use App\Enums\MobilePeriodEnum;
use App\Http\Controllers\Controller;
use App\Models\Plan\Plan;
use App\Models\Subscription;
use App\Models\SubscriptionSession;
use App\Models\User;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RevenueCatController extends Controller
{

    private array $payload;

    public function __construct(private readonly SubscriptionService $subscriptionService)
    {
    }

    public function webhook(Request $request)
    {
        $payload = $request->json()->all();
        $type = $payload['event']['type'] ?? null;

        if (!$type)
            abort(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->payload = $payload;
        $method = 'handle' . Str::studly(Str::lower($type));
        if (method_exists($this, $method))
            return $this->$method();

        abort(Response::HTTP_NOT_IMPLEMENTED);
    }

    private function getUser(): User
    {
        return User::findOrFail($this->payload['event']['app_user_id']);
    }


    private function handleInitialPurchase()
    {
        $data = $this->payload['event'];
        $user = $this->getUser();

        $subscription_code = md5(json_encode([
            'user' => $user,
            'time' => time(),
            'uniqid' => uniqid()
        ]));

        $subscriptionSession = SubscriptionSession::create([
            'period' => MobilePeriodEnum::from($data['product_id'])->getDefaultValue() ?? 'month',
            'plan_id' => Plan::first()->id,
            'user_id' => $user->id,
            'hash' => $subscription_code,
            'data' => $data
        ]);

        try {
            $this->subscriptionService
                ->create(
                    $subscriptionSession,
                    $this->payload,
                    $data['purchased_at_ms'],
                    $data['price_in_purchased_currency'],
                    Subscription::SOURCE_MOBILE,
                    Subscription::PROVIDER_REVENUECAT,
                );

            return Response::HTTP_OK;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function handleRenewal()
    {
        $data = $this->payload['event'];
        $user = $this->getUser();

        try {
            $this->subscriptionService
                ->continue(
                    $user->lastRevenueSubscription?->session,
                    $this->payload,
                    $data['purchased_at_ms'],
                    $data['price_in_purchased_currency']
                );

            return Response::HTTP_OK;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    private function handleCancellation()
    {
        $user = $this->getUser();

        try {
            $this->subscriptionService
                ->cancel($user->lastRevenueSubscription?->session);

            return Response::HTTP_OK;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function handleExpiration()
    {
        $user = $this->getUser();

        try {
            $this->subscriptionService
                ->cancel($user->lastRevenueSubscription?->session);

            return Response::HTTP_OK;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function handleTransfer()
    {
        $fromUser = User::find($this->payload['event']['transferred_from'][0]);
        $toUser = User::find($this->payload['event']['transferred_to'][1]);

        try {
            $this->subscriptionService->move($fromUser, $toUser);

            return Response::HTTP_OK;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
