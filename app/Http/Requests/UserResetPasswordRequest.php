<?php

namespace App\Http\Requests;

use App\Rules\LetterDigitsRule;
use Illuminate\Foundation\Http\FormRequest;

class UserResetPasswordRequest extends FormRequest
{

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'size:4'],
            'password' => ['required', 'min:8', 'confirmed', new LetterDigitsRule()],
            'password_confirmation' => 'required',
        ];
    }
}
