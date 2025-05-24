<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:100|regex:/^[а-яА-ЯёЁ\s]+$/u',
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users', 'email')],
            'password' => 'required|string|min:6|regex:/[a-z]/|regex:/[A-Z]/',
            'phone' => 'required|regex:/^\d-\d{3}-\d{3}-\d{2}-\d{2}$/',
            'image' => 'required|image'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'ФИО обязательно для заполнения',
            'name.max' => 'Поле "ФИО" не может превышать 100 символов',
            'name.regex' => 'ФИО должно состоять из символов кириллицы и не должно содержать цифры и знаки препинания',
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Email должен соответсвовать стандартному шаблону email-адресов',
            'email.max' => 'Поле "Email" не должно превышать 100 символов',
            'email.unique' => 'Данный пользователь уже зарегистрирован',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен содержать не менее 6 символов',
            'password.regex' => 'Пароль должен состоять из символов английского алфавита и содержать хотя бы одну строчную и одну заглавную букву',
            'phone.required' => 'Телефон обязятелен для заполнения',
            'phone.regex' => 'Телефон должен соответствовать формату x-xxx-xxx-xx-xx',
            'image.required' => 'Загрузите фото'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim(strip_tags($this->name)),
            'email' => trim(strip_tags($this->email)),
            'password' => trim(strip_tags($this->password)),
            'phone' => trim(strip_tags($this->phone))
        ]);
    }
}