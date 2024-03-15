<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SystemPage;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index(SystemPage $page)
    {
        return $page;
    }

}
