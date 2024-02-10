<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JWTAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 422);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 422);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is missing'], 422);
        }

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 422);
        }

        return $next($request);
    }
}
