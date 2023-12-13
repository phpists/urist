<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{

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
            'phone' => ['required', 'string', 'size:12'],
            'password' => ['required'],
        ];
    }
}
