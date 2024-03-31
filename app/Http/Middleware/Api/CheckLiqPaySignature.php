<?php

namespace App\Http\Middleware\Api;

use Closure;
use DigitalThreads\LiqPay\Exceptions\InvalidCallbackRequestException;
use DigitalThreads\LiqPay\LiqPay;
use DigitalThreads\LiqPay\LiqPaySdkClient;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLiqPaySignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $payload = LiqPay::validateCallback($request);
            $request->attributes->add(['payment' => serialize($payload)]);

            return $next($request);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            abort(403);
        }
    }
}
