<?php

namespace App\Http\Requests;

use App\Enums\Permissions;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MoveItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can(Permissions::FILE_CREATE->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item_id' => 'required',
            'folder_id' => ['sometimes', 'nullable', Rule::exists('folders', 'id')->where(function (Builder $query) {
                return $query->where('user_id', Auth::user()->id);
            })]
        ];
    }
}
