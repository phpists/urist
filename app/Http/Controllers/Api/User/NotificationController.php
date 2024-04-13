<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct(private readonly NotificationService $notificationService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new JsonResponse([
            'unread_count' => $this->notificationService->getUnreadCount(),
            'latest' => $this->notificationService->getLatest(),
        ]);
    }

    public function bulkRead(Request $request)
    {
        $ids = $request->post('ids');
        $result = false;
        if (is_array($ids) && !empty($ids))
            $result = NotificationService::bulkMarkAsRead($ids);

        return new JsonResponse([
            'result' => (bool) $result
        ]);
    }

}
