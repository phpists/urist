<?php

namespace App\Http\Controllers\User;

use App\Enums\SystemPageEnum;
use App\Http\Controllers\Controller;
use App\Models\Plan\Feature;
use App\Models\Plan\Plan;
use App\Models\SubscriptionSession;
use App\Services\LiqPayService;
use Carbon\Carbon;
use DigitalThreads\LiqPay\Dto\StdClassLiqPayPaymentDetails;
use DigitalThreads\LiqPay\LiqPay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{

    function __construct(private readonly LiqPayService $liqPayService)
    {
    }

    function index()
    {
        return view('user.subscription.index', [
            'user' => \Auth::user(),
            'plans' => Plan::active()->orderBy('pos')->get(),
            'features' => Feature::active()->orderBy('pos')->get(),
            'systemPage' => SystemPageEnum::USER_SUBSCRIPTION->getPage()
        ]);
    }

    function checkout(Request $request)
    {
        $payment = unserialize($request->attributes->get('payment'));

        if (!$payment) {
            \Log::error('Запит не містить платіжних даних');
            abort(500);
        }

        try {
            $message = $this->liqPayService->handleRequest($payment);
            return to_route('user.subscription.index')->with('success', $message);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . '|payload:' . json_encode($payment));
            return to_route('user.subscription.index')->with('error', 'Не вдалось створити підписку');
        }
    }

    function paymentData(Request $request, Plan $plan)
    {
        if (!$request->ajax())
            abort(Response::HTTP_NOT_FOUND);

        $period = $request->post('period');

        try {
            $prerequisites = $this->liqPayService->getCheckoutPrerequisites($request->user(), $plan, $period);

            return new JsonResponse([
                'action' => $prerequisites->getAction(),
                'data' => $prerequisites->getData(),
                'signature' => $prerequisites->getSignature(),
                'price_title' => $plan->getPriceWithPeriodByPeriod($period)
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return new JsonResponse([
                'message' => 'ERROR'
            ], 500);
        }
    }

    function cancel(Request $request)
    {
        if (!$request->user()->activeSubscription->session)
            return to_route('user.subscription.index')->with('error', 'Неможливо скасувати безкоштовну підписку');

        try {
            $message = $this->liqPayService->unsubscribe($request->user()->activeSubscription);
            return to_route('user.subscription.index')->with('success', $message);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return to_route('user.subscription.index')->with('error', 'Не вдалось скасувати підписку');
        }

    }

}
