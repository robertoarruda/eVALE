<?php

namespace Nero\ValeExpress\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeFormRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'cpf' => "required|unique:employees,cpf,{$this->employeeId}",
            'registration_number' => 'nullable',
            'consumption_limit' => 'required',
        ];

        if ($this->method() == 'POST') {
            $rules['password'] = 'required';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cpf.unique' => 'CPF informado já existe',
        ];
    }
}
