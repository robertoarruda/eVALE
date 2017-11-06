<?php

namespace Nero\Evale\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * @param Request $request
     * @param Rule $rule
     * @return array
     */
    public function rules(Request $request, Rule $rule)
    {
        $employeeId = $request->employeeId ?? 0;
        $companyId = $request->user()->id ?? 0;

        $registrationNumberUnique = $rule->unique('employees')
            ->ignore($employeeId)
            ->where(function ($query) use ($companyId) {
                return $query->where('company_id', $companyId);
            });

        $rules = [
            'name' => 'required',
            'cpf' => "required|unique:employees,cpf,{$employeeId}",
            'registration_number' => ['required', $registrationNumberUnique],
            'consumption_limit' => "required|subscription_limit:{$companyId},{$employeeId}",
        ];

        if (!empty($request->password)) {
            $rules['password'] = 'confirmed';
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
            'cpf.unique' => 'CPF informado já existe.',
            'registration_number.unique' => 'Número de matricula informado já existe.',
            'password.confirmed' => 'Confirmação da senha não confere.',
            'consumption_limit.subscription_limit' => 'Limite de consumo informado supera o limite da assinatura.',
        ];
    }
}
