<?php

namespace App\Http\Requests\Api\User\Files;

use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
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
            'folder_id' => ['nullable'],
            'name' => ['required', 'string', 'max:255'],
            'pp' => ['required', 'string'],
            'statya_kk' => ['required', 'string'],
        ];
    }
}
