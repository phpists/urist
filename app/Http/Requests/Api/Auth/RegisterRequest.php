<?php

namespace App\Http\Requests\Api\Auth;

use App\Rules\LetterDigitsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'size:12', Rule::unique('users')->whereNotNull('phone_verified_at')],
            'password' => ['required', 'min:8', 'confirmed', new LetterDigitsRule()],
            'password_confirmation' => 'required',
        ];
    }
}
