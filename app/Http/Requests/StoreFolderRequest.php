<?php

namespace App\Http\Requests;

use App\Enums\FolderType;
use App\Enums\PermissionEnum;
use App\Enums\Permissions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFolderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->post('folder_type') == FolderType::FAVOURITES_FOLDER->value)
            return $this->user()->can(PermissionEnum::CREATE_BOOKMARKS->value);
        else
            return $this->user()->can(PermissionEnum::CREATE_OWN_PAGES->value);
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
