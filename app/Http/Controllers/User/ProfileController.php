<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{

    public function index()
    {
        return view('user.profile.index', [
            'user' => \Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $result = $user->update($request->all());

        if ($request->wantsJson()) {
            return new JsonResponse([
                'result' => $result,
                'message' => $result
                    ? 'Дані успішно збережено'
                    : 'Не вдалось зберегти дані'
            ], $result ? 200 : 500);
        }

        return to_route('user.profile.index');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, \Auth::user()->password)) {
                    $fail('Неправильний пароль');
                }
            }],
            'new_password' => ['required', 'string', 'confirmed']
        ]);

        $result = \Auth::user()->update([
            'password' => \Hash::make($request->post('new_password'))
        ]);


        if ($request->wantsJson()) {
            return new JsonResponse([
                'result' => $result,
                'message' => $result
                    ? 'Пароль змінено'
                    : 'Не вдалось зберегти новий пароль'
            ], $result ? 200 : 500);
        }

        return back()->with('success', 'Пароль змінено');
    }

    public function searchCity(Request $request)
    {
        $response = Http::get('http://api.geonames.org/searchJSON', [
            'type' => 'json',
            'name' => $request->input('search'),
            'cities' => 'cities5000',
            'country' => 'UA',
            'lang' => 'uk',
            'maxRows' => 20,
            'username' => config('services.geonames.username')
        ]);

        $result = $response->json();
        $cities = [];
        if (isset($result['geonames'])) {
            foreach ($result['geonames'] as $city) {
                $cities[] = [
                    'id' => $city['name'],
                    'text' => $city['name']
                ];
            }
        }

        return response()->json([
            'results' => $cities
        ]);
    }

}
