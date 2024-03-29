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
        $code = $this->input('inputCode1').$this->input('inputCode2').$this->input('inputCode3').$this->input('inputCode4');
        $this->merge([
            'code' => $code,
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
