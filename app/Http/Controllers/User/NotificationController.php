<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function bulkMarkAsRead(Request $request)
    {
        $ids = $request->post('ids');
        $result = false;
        if (is_array($ids) && !empty($ids))
            $result = NotificationService::bulkMarkAsRead($ids);

        return new JsonResponse([
            'result' => $result
        ]);
    }

}
