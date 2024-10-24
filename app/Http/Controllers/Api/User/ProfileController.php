<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ProfileUpdateRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{

    public function index()
    {
        return new UserResource(\Auth::guard('api')->user());
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

    public function destroy()
    {
        $user = \Auth::user();
        $result = $user->delete();

        return new JsonResponse([
            'result' => $result,
            'message' => $result
                ? 'Аккаунт успішно видалено'
                : 'Не вдалось видалити аккаунт'
        ], $result ? 200 : 500);
    }
}
