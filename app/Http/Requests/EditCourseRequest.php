<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCourseRequest extends FormRequest
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
            'descr' => 'required|string|max:5000',
            'price' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'descr.required' => 'Описание обязательно для заполнения',
            'descr.max' => 'Поле "Описание" не может превышать 5000 символов',
            'price.required' => 'Стоимость обязательна для заполнения',
            'price.integer' => 'Стоимость должна быть целым числом'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'descr' => trim(strip_tags($this->descr)),
            'price' => trim(strip_tags($this->price))
        ]);
    }
}