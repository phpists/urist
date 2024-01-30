<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index()
    {
        return view('admin.notifications.index', [
            'notifications' => Notification::orderBy('id', 'DESC')->paginate()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'url']);
        $notification = new Notification($data);
        if ($notification->save()) {
            foreach (User::all() as $user) {
                $user->userNotifications()->create(['notification_id' => $notification->id]);
            }

            return back()->with('success', 'Сповіщення створено і розіслано користувачам');
        }

        return back()->with('error', 'Не вдалося створити сповіщення');
    }

}
