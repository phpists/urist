<?php

namespace App\Services;

class NotificationService
{

    public static function getUnread()
    {
        return \Auth::user()->unreadNotifications;
    }

    public static function bulkMarkAsRead(array $ids)
    {
        return \Auth::user()->userNotifications()->whereIn('notification_id', $ids)->update([
            'is_read' => 1
        ]);
    }

}
