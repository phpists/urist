<?php

namespace App\Http\Requests;

use App\Models\CriminalArticle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CriminalArticleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->hasRole('admin');
    }

    protected function prepareForValidation()
    {
        $article = CriminalArticle::whereName($this->get('name'))->first();
        if ($article) {
            \Session::flash('warning', "Стаття з такою назвою вже існує, ось посилання на оригінал: " . route('admin.criminal_article.edit', ['id' => $article->id]));
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:criminal_articles',
            'pp' => 'string|required',
            'statya_kk' => 'string|required',
            'article_categories' => 'required|array',
            'article_categories.*' => 'required|exists:article_categories,id',
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
            'nazva_pp.required' => 'Поле "Текст" обов’язкове для заповнення.',
            'pp.required' => 'Поле "Текст" обов’язкове для заповнення.',
            'statya_kk.required' => 'Поле "Текст" обов’язкове для заповнення.',
            'description.required' => 'Поле "Короткий Опис" обов’язкове для заповнення.',
            'article_categories.required' => 'Поле "Категорії" обов’язкове для заповнення.',
            'article_categories.exists' => 'Вибраної категорії не існує, виберіть іншу',
            'court_decision_link.required' => 'Поле "Посилання на рішення суду" обов’язкове для заповнення.'
        ];
    }
}
