<?php

namespace App\Http\Controllers;

use App\Enums\SettingEnum;
use App\Enums\SystemPageEnum;
use App\Services\SettingService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
       /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('pages.contacts', [
            'adminEmail' => SettingService::getValueByName(SettingEnum::ADMIN_EMAIL->value)
        ]);
    }
}
