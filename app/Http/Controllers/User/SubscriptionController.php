<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan\Feature;
use App\Models\Plan\Plan;
use DigitalThreads\LiqPay\LiqPay;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function index()
    {
        return view('user.subscription.index', [
            'plans' => Plan::active()->orderBy('pos')->get(),
            'features' => Feature::active()->orderBy('pos')->get()
        ]);
    }

    public function paymentData(Request $request, Plan $plan)
    {
        $period = $request->post('period');
        $data = [
            'action' => 'subscribe',
            'subscribe' => '1',
            'subscribe_periodicity' => $period,
            'amount' => $plan->getPriceByPeriod($period),
            'description' => 'Оформлення підписки "'. $plan->title .'"',
            'result_url' => route('web.checkout'),
            'server_url' => route('api.liqpay_callback'),
        ];

        $subscription_code = md5(json_encode(array_merge($data, [
            'user' => $request->user(),
            'time' => time(),
            'uniqid' => uniqid()
        ])));

        $data['subscription_id'] = $subscription_code;

        $prerequisites  = LiqPay::getCheckoutFormPrerequisites($data);

        return [
            'subscription_code' => $subscription_code,
            'action' => $prerequisites->getAction(),
            'data' => $prerequisites->getData(),
            'signature' => $prerequisites->getSignature(),
        ];
    }

}
