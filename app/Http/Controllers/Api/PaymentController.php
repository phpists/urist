<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function callback(Request $request)
    {
        $payload = $request->payload;
        dd($payload);
    }

}
