<?php

namespace Nero\Evale\Validators;

use Illuminate\Validation\Validator;
use Nero\Evale\Services\CompanyService;

class EmployeeValidator
{
    /**
     * @var \Nero\Evale\Services\CompanyService
     */
    protected $companyService;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Valida o limite de assinatura
     *
     * @param string $attribute Nome do campo
     * @param float $value Valor do campo
     * @param string $parameters
     * @param Validator $validator
     * @return boolean
     */
    public function validateSubscriptionLimit(
        string $attribute,
        float $value,
        array $parameters,
        Validator $validator
    ) {
        $remainingSubscription = $this->companyService
            ->remainingSubscription($parameters[0], [$parameters[1]]) ?? 0;

        return ($remainingSubscription - $value >= 0);
    }

}
