<?php

namespace Nero\ValeExpress\Repositories;

use Nero\ValeExpress\Models\Employee;

class EmployeeRepository extends Repository
{

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }
}
