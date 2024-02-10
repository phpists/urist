<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordVerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['required', 'exists:users,phone'],
            'code' => ['required', 'size:4']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
