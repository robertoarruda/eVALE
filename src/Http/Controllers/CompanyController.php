<?php

namespace Nero\ValeExpress\Http\Controllers;

use Nero\ValeExpress\Http\Requests\EmployeeFormRequest;
use Nero\ValeExpress\Services\EmployeeService;

class CompanyController extends Controller
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(EmployeeService $service)
    {
        $this->view = 'company';
        $this->service = $service;
    }

    /**
     * @see \Nero\ValeExpress\Http\Controllers\Controller::mainStore()
     */
    public function store(EmployeeFormRequest $request)
    {
        return parent::mainStore($request);
    }

    /**
     * @see \Nero\ValeExpress\Http\Controllers\Controller::mainUpdate()
     */
    public function update(EmployeeFormRequest $request, int $entityId)
    {
        return parent::mainUpdate($request, $entityId);
    }
}
