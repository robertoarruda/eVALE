<?php

namespace Nero\Evale\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FillUpFormRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $companyId = $request->company_id ?? 0;
        $employeeRegistrationNumber = $request->employee_registration_number ?? '';
        $employeePassword = $request->employee_password ?? '';

        $rules = [
            'company_id' => 'required',
            'fuel_type_id' => 'required',
            'employee_registration_number' => "required|employee_login:{$companyId},{$employeePassword}",
            'employee_password' => 'required',
            'value' => "required|consumption_limit:{$employeeRegistrationNumber}",
        ];

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
            'employee_registration_number.employee_login' => 'Senha inválida ou número de matrícula inexistente nesta empresa.',
            'value.consumption_limit' => 'Valor informado supera o limite de consumo do funcionário.',
        ];
    }
}
