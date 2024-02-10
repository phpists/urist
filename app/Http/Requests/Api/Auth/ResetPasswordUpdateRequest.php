<?php

namespace App\Http\Requests\Api\Auth;

use App\Rules\LetterDigitsRule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'phone' => ['required', 'exists:users,phone'],
            'password' => ['required', 'min:8', 'confirmed', new LetterDigitsRule()],
            'password_confirmation' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
