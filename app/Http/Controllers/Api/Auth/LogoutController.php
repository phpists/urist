<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{

    public function index()
    {
        \Auth::guard('api')->logout(true);
        return new JsonResponse([
            'result' => true
        ]);
    }

}
