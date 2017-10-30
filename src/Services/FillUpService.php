<?php

namespace Nero\Evale\Services;

use Nero\Evale\Repositories\CompanyRepository;
use Nero\Evale\Repositories\EmployeeRepository;

class FillUpService
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(
        CompanyRepository $companyRepository,
        EmployeeRepository $employeeRepository
    ) {
        $this->companyRepository = $companyRepository;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Lanca abastecimento
     *
     * @param int $companyId Id da empresa
     * @param string $employeeRegistrationNumber Matricula do funcionario
     * @param float $value Valor abastecido
     * @return array
     */
    public function post(string $employeeRegistrationNumber, float $value)
    {
    }
}
