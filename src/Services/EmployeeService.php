<?php

namespace Nero\Evale\Services;

use Carbon\Carbon;
use Nero\Evale\Repositories\EmployeeRepository;
use Nero\Evale\Traits\DateTrait;

class EmployeeService extends Service
{
    use DateTrait;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(
        EmployeeRepository $repository,
        Carbon $carbon
    ) {
        $this->repository = $repository;
        $this->carbon = $carbon;
    }

    /**
     * Lista de funcionario pelo id da empresa
     *
     * @param int $companyId Id da empresa
     * @param bool $complete
     * @return Colletion
     */
    public function findByCompanyId(int $companyId, bool $complete = false)
    {
        $employees = $this->find(['company_id' => $companyId]);
        if (!$complete) {
            return $employees;
        }

        $employees->each(function ($employee, $key) {
            $remainingConsumptionLimit = $this->remainingConsumptionLimit($employee->id);
            return $employee->remaining_consumption_limit = $remainingConsumptionLimit;
        });

        return $employees;
    }

    /**
     * Retorna o valor restante do limite de consumacao
     *
     * @param int $employeeId Id do funcionario
     * @param string $initialDate Data inicial da consulta
     * @param string $finalDate Data final da consulta
     * @return float
     */
    public function remainingConsumptionLimit(
        int $employeeId,
        string $initialDate = '',
        string $finalDate = ''
    ) {
        if (empty($employee = $this->findById($employeeId))) {
            return 0;
        }

        $totalConsumption = $employee->fillUps
            ->where('created_at', '>=', $this->dateOrStartOfMonth($initialDate))
            ->where('created_at', '<=', $this->dateOrEndOfMonth($finalDate))
            ->sum('value') ?? 0;

        return ($employee->consumption_limit ?? 0) - $totalConsumption;
    }
}
