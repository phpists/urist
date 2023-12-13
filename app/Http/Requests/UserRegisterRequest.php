<?php

namespace App\Http\Requests;

use App\Rules\LetterDigitsRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone' => formatNumbers($this->input('phone')),
        ]);
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'size:12', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed', new LetterDigitsRule()],
            'password_confirmation' => 'required',
            'policy' => ['required', 'accepted'],
            'g-recaptcha-response' => 'required|captcha',
        ];
    }
}
