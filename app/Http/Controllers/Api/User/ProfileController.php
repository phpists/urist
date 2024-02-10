<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function index()
    {
        return \Auth::guard('api')->user();
    }

}
