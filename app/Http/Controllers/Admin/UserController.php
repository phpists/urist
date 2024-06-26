<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserSubscriptionExpired;
use App\Http\Controllers\Controller;
use App\Models\Plan\Plan;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::query()
            ->when($search = $request->get('search'), function ($q) use($search) {
                return $q->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });

        $perPage = $request->get('per-page', 20);
        if ($perPage == 'all')
            $users = $users->get();
        else
            $users = $users->paginate($perPage)->withQueryString();

        if ($request->ajax() && $request->wantsJson()) {
            return new JsonResponse([
                'html' => view('admin.users.parts.table', [
                    'users' => $users
                ])->render()
            ]);
        }

        return view('admin.users.index', [
            'users' => $users,
            'users_count' => User::count(),
            'online_users_count' => DB::table(config('session.table'))
                ->distinct()
                ->select(['users.id'])
                ->whereNotNull('user_id')
                ->where('sessions.last_activity', '>', Carbon::now()->subMinutes(5)->getTimestamp())
                ->leftJoin('users', config('session.table') . '.user_id', '=', 'users.id')
                ->count(),
            'subscribed_users_count' => User::whereHas('activeSubscription')->count()
        ]);
    }

    public function subscribe(Request $request, User $user)
    {
        $addPeriod = 'add' . $period = $request->post('period', 'month');

        if ($user->activeSubscription) {
            $expiresAt =  $user->pendingSubscription->expires_at->$addPeriod();
        } else {
            $expiresAt = Carbon::now()->$addPeriod();
        }

        Subscription::create([
            'user_id' => $user->id,
            'plan_id' => Plan::find(1)->id,
            'period' => $period,
            'expires_at' => $expiresAt
        ]);

        return to_route('admin.users.index')
            ->with('success', "Підписка для користувача {$user->full_name} продовжена на " . __('subscription.'.$period));
    }

    public function unsubscribe(Request $request, User $user)
    {
        $user->activeSubscription()
            ->update([
                'cancelled_at' => Carbon::now(),
                'expires_at' => Carbon::now()
            ]);

        UserSubscriptionExpired::dispatch($user, false);

        return to_route('admin.users.index')
            ->with('success', 'Підписка анульована');
    }

}
