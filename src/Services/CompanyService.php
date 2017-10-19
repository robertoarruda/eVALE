<?php

namespace Nero\ValeExpress\Services;

use Nero\ValeExpress\Repositories\CompanyRepository;

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
