<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserVerifyPhoneRequest extends FormRequest
{

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'code' => formatNumbers($this->input('code')),
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required','size:4'],
        ];
    }
}
