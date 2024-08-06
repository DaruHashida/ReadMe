<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // или false, если есть дополнительные условия авторизации
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|min:4|string',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages()
    {
        return [
            'post_id.required' => 'Необходимо указать пост, к которому добавляется комментарий.',
            'post_id.exists' => 'Указанный пост не существует.',
            'content.required' => 'Необходимо ввести текст комментария.',
            'content.min' => 'Длина комментария должна быть не менее 4 символов.',
            'content.string' => 'Текст комментария должен быть строкой.',
            'content.trim' => 'Текст комментария не должен содержать начальные и конечные пробелы.',
        ];
    }
}
