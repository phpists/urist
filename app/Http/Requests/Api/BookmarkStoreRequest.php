<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BookmarkStoreRequest extends FormRequest
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
            'criminal_article_id' => ['required', 'exists:criminal_articles,id'],
            'folder_id' => ['nullable', 'exists:folders,id'],
            'name' => ['nullable', 'string', 'max:255']
        ];
    }
}
