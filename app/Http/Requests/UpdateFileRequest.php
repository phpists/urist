<?php

namespace App\Http\Requests;

use App\Enums\PermissionEnum;
use App\Enums\Permissions;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can(PermissionEnum::MARK_NEEDED->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pp' => 'required|string',
            'statya_kk' => 'required|string'
        ];
    }
}
