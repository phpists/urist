<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan\Feature;
use App\Models\Plan\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function index()
    {
        return view('user.subscription.index', [
            'plans' => Plan::active()->orderBy('pos')->get(),
            'features' => Feature::active()->orderBy('pos')->get()
        ]);
    }

}
