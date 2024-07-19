<?php

namespace App\Http\Requests\Api\User\Files;

use Illuminate\Foundation\Http\FormRequest;

class FileStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return can_user(\App\Enums\PermissionEnum::CREATE_OWN_PAGES->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'criminal_article_id' => ['required'],
            'folder_id' => ['nullable', 'exists:folders,id'],
            'name' => ['nullable', 'string', 'max:255']
        ];
    }
}
