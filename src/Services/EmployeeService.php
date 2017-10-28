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
}
