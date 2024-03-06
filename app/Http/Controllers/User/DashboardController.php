<?php

namespace App\Http\Controllers\User;

use App\Enums\SystemPageEnum;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('user.dashboard.index', [
            'systemPage' => SystemPageEnum::DASHBOARD->getPage()
        ]);
    }

}
