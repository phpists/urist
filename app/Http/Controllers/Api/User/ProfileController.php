<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ProfileUpdateRequest;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{

    public function index()
    {
        return \Auth::guard('api')->user();
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = \Auth::user();
        $result = $user->update($request->validated());

        return new JsonResponse([
            'result' => $result,
            'message' => $result
                ? 'Дані успішно збережено'
                : 'Не вдалось зберегти дані'
        ], $result ? 200 : 500);
    }

}
