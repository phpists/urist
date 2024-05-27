<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if ($e->getCode() == 404) {
                return response()->view('errors.404', [], 404);
            }
        });

        $this->renderable(function (ThrottleRequestsException $e) {
            $retryAfter = $e->getHeaders()['Retry-After'] ?? 99;
            $message = "Забагато спроб! Будь ласка, спробуйте через {$retryAfter} сек";

            return request()->wantsJson()
                ? \Response::json([
                    'result' => false,
                    'message' => $message
                ])
                : back()->with('error', $message);
        });
    }
}
