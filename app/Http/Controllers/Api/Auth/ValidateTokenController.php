<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ValidateTokenController extends Controller
{

    public function __invoke(Request $request)
    {
        $token = $request->get('token');

        $user = User::whereCurrentApiToken($token)->first();

        if ($user) {
            return \Response::json([
                'valid' => true
            ]);
        } else {
            return \Response::json([
                'valid' => false
            ]);
        }
    }

}
