<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, ...$plan): Response
    {
        $permissions = Auth::user()->permissions->pluck('name');
        $commonValues = $permissions->intersect(collect($plan));
        if ($commonValues->isNotEmpty()) {
            return $next($request);
        }
        //Change to your custom page
        abort(403);
    }
}
