<?php

namespace Nero\Evale\Http\Requests;

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
        $companyId = $this->user()->id ?? 0;

        $rules = [
            'name' => 'required',
            'cpf' => "required|unique:employees,cpf,{$this->employeeId}",
            'registration_number' => "required|unique:employees,registration_number,{$this->employeeId}",
            'consumption_limit' => "required|subscription_limit:{$companyId},{$this->employeeId}",
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
            'registration_number.unique' => 'Número de matricula informado já existe',
        ];
    }
}
