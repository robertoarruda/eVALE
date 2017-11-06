<?php

namespace Nero\Evale\Services;

use Carbon\Carbon;
use Nero\Evale\Repositories\CompanyRepository;
use Nero\Evale\Traits\DateTrait;

class CompanyService extends Service
{
    use DateTrait;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(
        CompanyRepository $repository,
        Carbon $carbon
    ) {
        $this->repository = $repository;
        $this->carbon = $carbon;
    }

    /**
     * Busca registro pelos parametros
     * @param array $params
     * @param bool $complete
     * @return Colletion
     */
    public function find(array $params = [], bool $complete = false)
    {
        $companies = $this->repository->find($params);
        if (!$complete) {
            return $companies;
        }

        $companies->each(function ($company, $key) {
            $consumption = $this->consumption($company->id);
            return $company->consumption = $consumption;
        });

        return $companies;
    }

    /**
     * Retorna o valor restante da assinatura da empresa
     *
     * @param int $companyId Id da empresa
     * @param array $ignoredEmployees Id de funcionarios ignorados na conta
     * @return float
     */
    public function remainingSubscription(int $companyId, array $ignoredEmployees = [])
    {
        $company = $this->findById($companyId);

        $totalConsumptionLimit = $company->employees
            ->whereNotIn('id', $ignoredEmployees)
            ->sum('consumption_limit') ?? 0;

        return ($company->subscription_limit ?? 0) - $totalConsumptionLimit;
    }

    /**
     * Retorna o valor de consumacao da empresa
     *
     * @param int $companyId Id da empresa
     * @param string $initialDate Data inicial da consulta
     * @param string $finalDate Data final da consulta
     * @return float
     */
    public function consumption(
        int $companyId,
        string $initialDate = '',
        string $finalDate = ''
    ) {
        if (empty($company = $this->findById($companyId))) {
            return 0;
        }

        return $company->fillUps
            ->where('created_at', '>=', $this->dateOrStartOfMonth($initialDate))
            ->where('created_at', '<=', $this->dateOrEndOfMonth($finalDate))
            ->sum('value') ?? 0;
    }

}
