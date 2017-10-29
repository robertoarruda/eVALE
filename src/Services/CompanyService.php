<?php

namespace Nero\Evale\Services;

use Nero\Evale\Repositories\CompanyRepository;

class CompanyService extends Service
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retorna o valor restante da assinatura da empresa
     *
     * @param int $companyId Id da empresa
     * @return float
     */
    public function remainingSubscription(int $companyId)
    {
        $company = $this->findById($companyId);

        $totalConsumptionLimit = $company->employees->sum('consumption_limit') ?? 0;

        return ($company->subscription_limit ?? 0) - $totalConsumptionLimit;
    }
}
