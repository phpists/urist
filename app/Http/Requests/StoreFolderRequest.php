<?php

namespace App\Http\Requests;

use App\Enums\FolderType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFolderRequest extends FormRequest
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
            'parent_id' => ['sometimes', 'exists:folders,id', 'nullable'],
            'folder_type' => [Rule::enum(FolderType::class)]
        ];
    }
}
