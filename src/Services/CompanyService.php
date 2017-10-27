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
}
