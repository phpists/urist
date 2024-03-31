<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use App\Models\SubscriptionSession;
use App\Services\LiqPayService;
use Carbon\Carbon;
use DigitalThreads\LiqPay\Contracts\LiqPayPaymentDetailsInterface;
use Illuminate\Http\Request;

class LiqPayController extends Controller
{

    public function callback(Request $request)
    {
        $payment = unserialize($request->attributes->get('payment'));

        if (!$payment) {
            \Log::error('Запит не містить платіжних даних');
            abort(500);
        }

        try {
            (new LiqPayService)->handleRequest($payment);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . '|payload:' . json_encode($request->payload));
        }
    }

}
