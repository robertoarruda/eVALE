<?php

namespace Nero\Evale\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'cnpj' => "required|unique:companies,cnpj,{$this->companyId}",
            'address' => 'nullable',
            'phone' => 'nullable',
            'subscription_limit' => 'required',
            'login' => "required|unique:companies,login,{$this->companyId}",
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
            'cnpj.unique' => 'CNPJ informado já existe',
            'login.unique' => 'Login informado já existe',
        ];
    }
}
