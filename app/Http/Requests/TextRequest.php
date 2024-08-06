<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TextRequest extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required|max:16000',
            'hashtags' => ['required', 'string', 'regex:/^(?:[\p{L}\d]+\s?)+$/u'],
        ];
    }

    /**
     * Кастомные сообщения об ошибках валидации
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'title.max' => 'Заголовок не должен превышать :max символов.',
            'content.required' => 'Пожалуйста, введите текст поста.',
            'content.max' => 'Текст поста не должен превышать 16000 символов.',
            'hashtags.required' => 'Поле "Хэштеги" обязательно для заполнения.',
            'hashtags.string' => 'Хэштеги должны быть строкой.',
            'hashtags.regex' => 'Неверный формат хэштегов. Хэштеги должны состоять из слов, разделенных пробелами.',
        ];
    }
}
