<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RegistryResource;
use App\Models\Registry;
use Illuminate\Http\Request;

class RegistryController extends Controller
{

    public function index(Request $request)
    {
        return RegistryResource::collection(Registry::paginate());
    }

}
