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
        $data = [
            'action' => 'subscribe',
            'subscribe' => '1',
            'subscribe_date_start' => Carbon::now()->setTimezone('UTC')->format('Y-m-d H:i:s'),
            'subscribe_periodicity' => $period,
            'amount' => $plan->getPriceByPeriod($period),
            'description' => 'Оформлення підписки "'. $plan->title .'"',
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

        $addPeriod = 'add' . ucfirst($subscriptionSession->period);
        $endAt = Carbon::createFromTimestamp(substr($this->payment->get('end_date'), 0, -3))
            ->$addPeriod()
            ->format('Y-m-d');

        if (!$subscriptionSession->subscription) {
            $subscription = $subscriptionSession->subscription()->create([
                'plan_id' => $subscriptionSession->plan_id,
                'user_id' => $subscriptionSession->user_id,
                'period' => $subscriptionSession->period,
                'price' => $this->payment->get('amount'),
                'expires_at' => $endAt
            ]);

            $subscriptionPayment = $subscription->payments()->create([
                'amount' => $this->payment->get('amount'),
                'end_at' => $endAt,
                'payload' => current((array)$this->payment),
            ]);

            $subscription->user->assignRole($subscription->plan->role);
        }

        return 'Підписка успішно створена';
    }

    /**
     * @throws Exception
     */
    private function handleUnsubscribe(): string
    {
        $subscription = SubscriptionSession::whereHash($this->payment->get('order_id'))
            ->firstOrFail()
            ->subscription;


        $subscription->cancelled_at = Carbon::now();
        if (!$subscription->save())
            throw new Exception('Не вдалось скасувати підписку');

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
        $addPeriod = 'add' . ucfirst($subscriptionSession->period);
        $endAt = Carbon::createFromTimestamp(substr($this->payment->get('end_date'), 0, -3))
            ->$addPeriod()
            ->format('Y-m-d');

        $subscriptionSession->subscription->update([
            'expires_at' => $endAt
        ]);

        $subscriptionPayment = $subscriptionSession->subscription->payments()->create([
            'amount' => $this->payment->get('amount'),
            'end_at' => $endAt,
            'payload' => current((array) $this->payment),
        ]);

        return  'Підписка успішно продовжена';
    }

}
