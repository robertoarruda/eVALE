<?php

namespace Nero\ValeExpress\Http\Controllers;

use Nero\ValeExpress\Services\CompanyService;

class CompanyController extends Controller
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(CompanyService $service)
    {
        $this->entity = 'company';
        $this->service = $service;
    }
}
