<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' =>'same:password',
            'file' => 'nullable|image|mimes:png,jpg|max:2048',
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
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.string' => 'Поле "Имя" должно содержать строку.',
            'name.max' => 'Длина поля "Имя" не должна превышать :max символов.',
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.string' => 'Поле "Email" должно содержать строку.',
            'email.email' => 'Поле "Email" должно содержать корректный адрес электронной почты.',
            'email.max' => 'Длина поля "Email" не должна превышать :max символов.',
            'email.unique' => 'Введенный адрес электронной почты уже занят.',
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.string' => 'Поле "Пароль" должно содержать строку.',
            'password.min' => 'Длина поля "Пароль" должна быть не менее :min символов.',
            'password.confirmed' => 'Поля "Пароль" и "Подтверждение пароля" должны совпадать.',
            'password_confirmation.same'=> 'Поля "Пароль" и "Подтверждение пароля" должны совпадать.',
            'file.image' => 'Поле "Аватар" должно содержать файл изображения.',
            'file.mimes' => 'Поле "Аватар" должно содержать файл в формате PNG или JPG.',
            'file.max' => 'Размер файла в поле "Аватар" не должен превышать :max килобайт.',
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'file' =>'Аватар',
        ];
    }

}
