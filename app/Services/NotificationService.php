<?php

namespace App\Services;

class NotificationService
{

    public function getLatest()
    {
        return \Auth::user()->latestNotifications;
    }

    public function getUnreadCount()
    {
        return \Auth::user()->unreadNotifications()->count();
    }

    public static function bulkMarkAsRead(array $ids)
    {
        return \Auth::user()->userNotifications()->whereIn('notification_id', $ids)->update([
            'is_read' => 1
        ]);
    }

}
