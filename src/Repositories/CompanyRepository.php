<?php

namespace Nero\ValeExpress\Repositories;

use Nero\ValeExpress\Models\Company;

class CompanyRepository extends Repository
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(Company $repository)
    {
        $this->model = $repository;
    }
}
