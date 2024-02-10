<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequestRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'phone' => ['required', 'exists:users,phone']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

}
