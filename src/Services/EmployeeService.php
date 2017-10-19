<?php

namespace Nero\ValeExpress\Services;

use Nero\ValeExpress\Repositories\EmployeeRepository;

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
