<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewFileRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return can_user(\App\Enums\PermissionEnum::CREATE_OWN_PAGES->value);
    }

    protected function prepareForValidation()
    {
        if ($this->post('folder_id') == 0)
            $this->offsetUnset('folder_id');
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
            'document' => ['required', 'file', 'max:5000', 'mimes:doc,docx'],
            'folder_id' => ['sometimes', 'exists:folders,id', 'nullable'],
        ];
    }

}
