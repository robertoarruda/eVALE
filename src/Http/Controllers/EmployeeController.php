<?php

namespace Nero\ValeExpress\Http\Controllers;

use Nero\ValeExpress\Services\EmployeeService;

class EmployeeController extends Controller
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(EmployeeService $service)
    {
        $this->entity = 'employee';
        $this->service = $service;
    }
}
