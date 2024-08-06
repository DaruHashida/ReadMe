<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'hashtags' => ['required', 'string', 'regex:/^(?:[\p{L}\d]+\s?)+$/u'],
            'video'=>'required|url',
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
            'hashtags.required' => 'Поле "Хэштеги" обязательно для заполнения.',
            'hashtags.string' => 'Хэштеги должны быть строкой.',
            'hashtags.regex' => 'Неверный формат хэштегов. Хэштеги должны состоять из слов, разделенных пробелами.',
            'video.required' => 'Поле "Ссылка youtube" обязательно для заполнения.',
            'video.url' => 'Поле "Ссылка youtube" должно содержать действительный URL-адрес.'
        ];
    }
}
