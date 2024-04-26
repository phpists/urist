<?php

namespace App\Http\Controllers\User;

use App\Enums\SystemPageEnum;
use App\Http\Controllers\Controller;
use App\Models\Registry;

class RegistryController extends Controller
{

    public function index()
    {
        $registries = Registry::paginate()
            ->withQueryString();

        $systemPage = SystemPageEnum::USER_REGISTRIES->getPage();

        return view('user.registries.index', compact('registries', 'systemPage'));
    }

}
