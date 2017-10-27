<?php

namespace Nero\Evale\Repositories;

use Nero\Evale\Models\Company;

class CompanyRepository extends Repository
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(Company $model)
    {
        $this->model = $model;
    }
}
