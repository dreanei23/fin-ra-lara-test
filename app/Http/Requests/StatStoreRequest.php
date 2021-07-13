<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StatStoreRequest extends FormRequest
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
            'date' => 'required_without_all:clear|date'
        ];
    }

    /**
     * Сообщения об ошибках
     */
    public function messages()
    {
        return [
            'required_without_all' => 'Параметр :attribute обязательный',
            'date' => 'Параметр :attribute неверный формат',
        ];
    }

    /**
     * Если валидация не прошла, то выдаем error
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 400));
    }
}
