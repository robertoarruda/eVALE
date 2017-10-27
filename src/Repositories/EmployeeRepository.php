<?php

namespace Nero\Evale\Repositories;

use Nero\Evale\Models\Employee;

class EmployeeRepository extends Repository
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }
}
