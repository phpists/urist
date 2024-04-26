<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->isSuperAdmin() || $request->user()->activeSubscription)
            return $next($request);

        return to_route('user.subscription.index')->with('error', 'Для користування цим функціоналом потрібна підписка');
    }
}
