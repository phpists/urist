<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WelcomeHint;
use Illuminate\Http\Request;

class WelcomeHintController extends Controller
{

    public function store(Request $request, WelcomeHint $welcomeHint)
    {
        \Auth::user()->welcomeHints()->attach($welcomeHint);
    }

}
