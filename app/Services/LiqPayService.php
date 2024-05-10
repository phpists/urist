<?php

namespace App\Services;

use App\Models\Plan\Plan;
use App\Models\Subscription;
use App\Models\SubscriptionSession;
use App\Models\User;
use Carbon\Carbon;
use DigitalThreads\LiqPay\Contracts\LiqPayCheckoutFormPrerequisitesInterface;
use DigitalThreads\LiqPay\Contracts\LiqPayPaymentDetailsInterface;
use DigitalThreads\LiqPay\Dto\StdClassLiqPayPaymentDetails;
use DigitalThreads\LiqPay\LiqPay;
use DigitalThreads\LiqPay\LiqPaySdkClient;
use Exception;
use Illuminate\Http\Request;

class LiqPayService
{

    private LiqPayPaymentDetailsInterface $payment;

    /**
     * @throws Exception
     */
    final function handleRequest(LiqPayPaymentDetailsInterface $payment): string
    {
        $this->payment = $payment;

        return match ($this->payment->get('action')) {
            'subscribe' => match ($this->payment->get('status')) {
                'subscribed' => $this->handleNewSubscription(),
                'unsubscribed' => $this->handleUnsubscribe()
            },
            'regular' => $this->handleRegularPayment(),
        };
    }

    final function getCheckoutPrerequisites(User $user, Plan $plan, string $period): LiqPayCheckoutFormPrerequisitesInterface
    {
        if ($user->activeSubscription?->isCancelled()) {
            $start_date = $user->activeSubscription->expires_at;
        } else {
            $start_date = Carbon::now();
        }

        $data = [
            'action' => 'subscribe',
            'subscribe' => '1',
            'subscribe_date_start' => Carbon::parse($start_date)->setTimezone('UTC')->format('Y-m-d H:i:s'),
            'subscribe_periodicity' => $period,
            'amount' => $plan->getPriceByPeriod($period),
            'description' => 'Оформлення підписки',
            'result_url' => route('subscription.checkout'),
            'server_url' => route('api.liqpay.callback'),
        ];

        $subscription_code = md5(json_encode(array_merge($data, [
            'user' => $user,
            'time' => time(),
            'uniqid' => uniqid()
        ])));

        $data['order_id'] = $subscription_code;

        SubscriptionSession::create([
            'period' => $period,
            'plan_id' => $plan->id,
            'user_id' => \Auth::id(),
            'hash' => $subscription_code,
            'data' => $data
        ]);

        return LiqPay::getCheckoutFormPrerequisites($data);
    }

    /**
     * @throws Exception
     */
    final function unsubscribe(Subscription $subscription): string
    {
        if (!$subscription->session)
            throw new Exception('Не вдалось оприділити сесію підписки');

        $liqPay = new \LiqPay(config('liqpay.public_key'), config('liqpay.private_key'));
        $response = $liqPay->api('request', [
            'action' => 'unsubscribe',
            'version' => '3',
            'order_id' => $subscription->session->hash
        ]);

        return $this->handleRequest(new StdClassLiqPayPaymentDetails((object) $response));
    }


    /**
     * @throws Exception
     */
    private function handleNewSubscription(): string
    {
        $subscriptionSession = SubscriptionSession::whereHash($this->payment->get('order_id'))->firstOrFail();
        if (!$subscriptionSession)
            throw new Exception('Не вдалось знайти платіжну сесію');

        (new SubscriptionService($subscriptionSession))
            ->create(
                current((array)$this->payment),
                $this->payment->get('end_date'),
                $this->payment->get('amount')
            );

        return 'Підписка успішно створена';
    }

    /**
     * @throws Exception
     */
    private function handleUnsubscribe(): string
    {
        $subscriptionSession = SubscriptionSession::whereHash($this->payment->get('order_id'))
            ->firstOrFail();

        (new SubscriptionService($subscriptionSession))
            ->cancel();

        return 'Підписка скасована';
    }

    /**
     * @throws Exception
     */
    private function handleRegularPayment(): string
    {
        if ($this->payment->get('status') !== 'success')
            throw new Exception('Не вдалось продовжити підписку');

        $subscriptionSession = SubscriptionSession::whereHash($this->payment->get('order_id'))->firstOrFail();
        (new SubscriptionService($subscriptionSession))
            ->continue(
                current((array)$this->payment),
                $this->payment->get('end_date'),
                $this->payment->get('amount')
            );

        return  'Підписка успішно продовжена';
    }

}
