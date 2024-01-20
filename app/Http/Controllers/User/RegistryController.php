<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Registry;

class RegistryController extends Controller
{

    public function index()
    {
        $registries = Registry::paginate()
            ->withQueryString();

        return view('user.registries.index', compact('registries'));
    }

}
