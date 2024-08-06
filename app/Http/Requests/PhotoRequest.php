<?php
// app/Http/Requests/CreatePostRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'hashtags' => ['required', 'string', 'regex:/^(?:[\p{L}\d]+\s?)+$/u'],
            'image' => [$this->requireAtLeastOneImage(), 'mimes:png,jpeg,jpg,gif'],
            'image_url'=>'nullable|url|downloadable_image',
        ];
    }

    /**
     * Требует, чтобы как минимум одно из полей (файл или ссылка) было заполнено.
     * Если заполнены оба поля, игнорирует ссылку.
     *
     * @return string
     */
    private function requireAtLeastOneImage()
    {
        if (!$this->file('image') && !$this->input('image_url')) {
            return 'required';
        }
        elseif ($this->input('image_url')) {
            return 'nullable';
        }
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
            'image.required' => 'Необходимо загрузить изображение или указать URL-адрес изображения.',
            'image.mimes' => 'Допускаются только изображения в форматах: :values.',
            'image_url.url' => 'Поле "URL изображения" должно содержать действительный URL-адрес.',
        ];
    }

}

