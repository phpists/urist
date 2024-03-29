<?php

namespace App\Http\Requests;

use App\Enums\Permissions;
use Illuminate\Foundation\Http\FormRequest;

class DeleteFolderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
//        return $this->user()->can(Permissions::FILE_CREATE->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'folder_id' => 'required'
        ];
    }
}
