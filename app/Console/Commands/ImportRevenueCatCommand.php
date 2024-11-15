<?php

namespace App\Console\Commands;

use App\Enums\MobilePeriodEnum;
use App\Models\Plan\Plan;
use App\Models\Subscription;
use App\Models\SubscriptionSession;
use App\Models\User;
use App\Services\SubscriptionService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ImportRevenueCatCommand extends Command
{
    protected $signature = 'import:revenue-cat {user_id} {subscription_type} {purchased} {--price=150} {--cancelled_at=}';

    protected $description = 'Import RevenueCat subscriptions';

    private array $payload = [
        'data' => ['subscribed manually']
    ];

    public function handle(): void
    {
        $user = User::findOrFail($this->argument('user_id'));

        $subscription_code = md5(json_encode([
            'user' => $user,
            'time' => time(),
            'uniqid' => uniqid()
        ]));

        $subscriptionSession = SubscriptionSession::create([
            'period' => MobilePeriodEnum::from($this->argument('subscription_type'))->getDefaultValue() ?? 'month',
            'plan_id' => Plan::first()->id,
            'user_id' => $user->id,
            'hash' => $subscription_code,
            'data' => $this->payload['data'],
        ]);

        try {
            (new SubscriptionService)
                ->create(
                    $subscriptionSession,
                    $this->payload,
                    $this->argument('purchased'),
                    $this->option('price'),
                    Subscription::SOURCE_MOBILE,
                    Subscription::PROVIDER_REVENUECAT,
                );



            if ($cancelled_at = $this->option('cancelled_at')) {
                (new SubscriptionService)
                    ->cancel($subscriptionSession, $cancelled_at);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
