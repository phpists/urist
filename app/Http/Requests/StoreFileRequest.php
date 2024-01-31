<?php

namespace App\Http\Requests;

use App\Enums\Permissions;
use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
//        return $this->user()->can(Permissions::FILE_CREATE->value);
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
            'name' => 'required|string',
            'folder_id' => 'sometimes|exists:folders,id|nullable',
            'criminal_article_id' => 'required'
        ];
    }
}
