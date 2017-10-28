<?php

namespace Nero\Evale\Validator;

use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;

class EmployeeValidator
{
    /**
     * @var \Nero\Evale\Services\CompanyService
     */
    protected $companyService;

    /**
     * @var \Nero\Evale\Services\EmployeeService
     */
    protected $employeeService;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(
        CompanyService $companyService,
        EmployeeService $employeeService
    ) {
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
    }

    public function validateSubscriptionLimit($attribute, $value, $parameters, $validator)
    {
        $remainingSubscription = $this->companyService
            ->remainingSubscription($parameters[0]) ?? 0;

        $currentConsumptionLimit = $this->employeeService
            ->findById($parameters[1])
            ->consumption_limit ?? 0;

        if ($remainingSubscription + $currentConsumptionLimit - $value < 0) {
            return false;
        }

        return true;
    }

}
