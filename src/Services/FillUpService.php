<?php

namespace Nero\Evale\Services;

use Carbon\Carbon;
use Nero\Evale\Repositories\FillUpRepository;
use Nero\Evale\Services\EmployeeService;
use Nero\Evale\Services\Service;
use Nero\Evale\Traits\DateTrait;

class FillUpService extends Service
{
    use DateTrait;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(
        FillUpRepository $repository,
        EmployeeService $employeeService,
        Carbon $carbon
    ) {
        $this->repository = $repository;
        $this->employeeService = $employeeService;
        $this->carbon = $carbon;
    }

    /**
     * Retorna os abastecimentos pelo filtro
     *
     * @param int $companyId Id da empresa
     * @param int $employeeId Id do funcionario
     * @param string $initialDate Data inicial da consulta
     * @param string $finalDate Data final da consulta
     * @return \Collection
     */
    public function filter(
        int $companyId = 0,
        int $employeeId = 0,
        string $initialDate = '',
        string $finalDate = ''
    ) {
        $conditions = [
            ['created_at', '>=', $this->dateOrStartOfMonth($initialDate)],
            ['created_at', '<=', $this->dateOrEndOfMonth($finalDate)],
        ];

        if ($companyId) {
            $conditions['company_id'] = $companyId;
        }

        if ($employeeId) {
            $conditions['employee_id'] = $employeeId;
        }

        return $this->find($conditions);
    }

    /**
     * Lanca abastecimento
     *
     * @param int $companyId Id da empresa
     * @param string $employeeRegistrationNumber Matricula do funcionario
     * @param float $value Valor abastecido
     * @return Nero\Evale\Models\FillUp
     */
    public function post(array $fillUp)
    {
        $fillUp['employee_id'] = $this->employeeService
            ->find([
                'company_id' => $fillUp['company_id'],
                'registration_number' => $fillUp['employee_registration_number'],
            ])
            ->first()
            ->id ?? 0;

        return $this->create($fillUp);
    }

}
