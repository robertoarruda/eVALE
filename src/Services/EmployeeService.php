<?php

namespace Nero\Evale\Services;

use Nero\Evale\Repositories\EmployeeRepository;

class EmployeeService extends Service
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retorna o valor restante da assinatura da empresa
     *
     * @param int $companyId Id da empresa
     * @return float
     */
    public function companyRemainingSubscription(int $companyId)
    {
        $totalConsumptionLimit = $this->sum('consumption_limit', ['company_id' => $companyId]) ?? 0;

        $subscriptionLimit = $this->find(['company_id' => $companyId])
            ->first()
            ->company
            ->subscription_limit ?? 0;

        return $subscriptionLimit - $totalConsumptionLimit;
    }
}
