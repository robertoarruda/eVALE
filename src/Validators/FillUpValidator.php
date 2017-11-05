<?php

namespace Nero\Evale\Validators;

use Hash;
use Illuminate\Validation\Validator;
use Nero\Evale\Services\EmployeeService;

class FillUpValidator
{
    /**
     * @var \Nero\Evale\Services\EmployeeService
     */
    protected $employeeService;

    /**
     * Metodo construtor da classe
     *
     * @param EmployeeService $employeeService
     * @param Hash $hash
     * @return void
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Valida o funcionario pela empresa matricula e senha
     *
     * @param string $attribute Nome do campo
     * @param string $value Valor do campo
     * @param string $parameters
     * @param Validator $validator
     * @return boolean
     */
    public function validateEmployeeLogin(
        string $attribute,
        string $value,
        array $parameters,
        Validator $validator
    ) {
        $password = $this->employeeService
            ->find([
                'company_id' => $parameters[0] ?? 0,
                'registration_number' => $value,
            ])
            ->first()
            ->password ?? 0;

        if (empty($password)) {
            return false;
        }

        return Hash::check($parameters[1] ?? 0, $password);
    }

    /**
     * Valida o limite de consumo
     *
     * @param string $attribute Nome do campo
     * @param float $value Valor do campo
     * @param string $parameters
     * @param Validator $validator
     * @return boolean
     */
    public function validateConsumptionLimit(
        string $attribute,
        float $value,
        array $parameters,
        Validator $validator
    ) {
        if (!empty($validator->failed()['employee_registration_number'])) {
            return true;
        }

        $employeeId = $this->employeeService
            ->find(['registration_number' => $parameters[0]])
            ->first()
            ->id ?? 0;

        if (empty($employeeId)) {
            return false;
        }

        $remainingConsumptionLimit = $this->employeeService
            ->remainingConsumptionLimit($employeeId) ?? 0;

        return ($remainingConsumptionLimit - $value >= 0);
    }

}
