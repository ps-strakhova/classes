<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreCourseRequest extends FormRequest
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
            'name' => 'required|string|max:150|unique:courses,name',
            'descr' => 'required|string|max:1000',
            'course_type' => 'required',
            'participants' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'event_time' => 'required',
            'price' => 'required|integer',
            'image' => 'required|image'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название курса обязательно для заполнения',
            'name.max' => 'Название не должно превышать 150 символов',
            'name.unique' => 'Название должно быть уникальным',
            'descr.required' => 'Описание обязательно для заполнения',
            'descr.max' => 'Описание не должно превышать 1000 символов',
            'participants.required' => 'Количество участников обязательно для заполнения',
            'start_date.required' => 'Дата начала обязательна для заполнения',
            'event_time.required' => 'Время начала обязательно для выбора',
            'price.required' => 'Стоимость необходима для заполнения',
            'price.integer' => 'Стоимость должна быть целым числом',
            'image.required' => 'Необходимо изображение для курса'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => strip_tags(trim($this->name)),
            'descr' => strip_tags(trim($this->descr)),
            'participants' => strip_tags(trim($this->participants)),
            'price' => strip_tags(trim($this->price)),
            'start_date' => $this->start_date ? Carbon::parse($this->start_date)->format('Y-m-d') : null
        ]);
    }
}