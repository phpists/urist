<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CriminalArticleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => ['required', 'string', Rule::unique('criminal_articles')->ignore($this->input('id'))],
            'pp' => 'string|required',
            'statya_kk' => 'string|required',
            'article_category_id' => 'required|exists:article_categories,id',
            'description' => 'required|string',
            'court_decision_link' => 'nullable|string',
            'tag_list' => 'array',
            'date' => ['required', 'date']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Назва" обов’язкове для заповнення.',
            'name.unique' => 'Значення для поля "Назва" вже використвується, спробуйте іншу.',
            'content.required' => 'Поле "Текст" обов’язкове для заповнення.',
            'description.required' => 'Поле "Короткий Опис" обов’язкове для заповнення.',
            'article_category_id.required' => 'Поле "Категорія" обов’язкове для заповнення.',
            'article_category_id.exists' => 'Вибрана категорія не існує, виберіть іншу',
            'court_decision_link.required' => 'Поле "Посилання на рішення суду" обов’язкове для заповнення.'
        ];
    }
}
