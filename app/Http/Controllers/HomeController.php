<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackFormMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function form(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'message' => ['required'],
        ]);

        return new JsonResponse([
            'result' => Mail::to(config('app.admin_email'))
                ->send(
                    new FeedbackFormMail(
                        $request->post('name'),
                        $request->post('email'),
                        $request->post('message')
                    )
                )
        ]);
    }

}
