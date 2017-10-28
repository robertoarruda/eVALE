<?php

namespace Nero\Evale\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CompanyFormRequest extends FormRequest
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
        $companyId = $request->companyId ?? 0;

        $rules = [
            'name' => 'required',
            'cnpj' => "required|unique:companies,cnpj,{$companyId}",
            'address' => 'nullable',
            'phone' => 'nullable',
            'subscription_limit' => 'required',
            'login' => "required|unique:companies,login,{$companyId}",
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
            'cnpj.unique' => 'CNPJ informado já existe.',
            'login.unique' => 'Login informado já existe.',
            'password.confirmed' => 'Confirmação da senha não confere.',
        ];
    }
}
