<?php

namespace Nero\ValeExpress\Http\Controllers;

use Nero\ValeExpress\Http\Requests\CompanyFormRequest;
use Nero\ValeExpress\Services\CompanyService;

class AdminController extends Controller
{
    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(CompanyService $service)
    {
        $this->view = 'admin';
        $this->service = $service;
    }

    /**
     * @see \Nero\ValeExpress\Http\Controllers\Controller::mainStore()
     */
    public function store(CompanyFormRequest $request)
    {
        return parent::mainStore($request);
    }

    /**
     * @see \Nero\ValeExpress\Http\Controllers\Controller::mainUpdate()
     */
    public function update(CompanyFormRequest $request, int $entityId)
    {
        return parent::mainUpdate($request, $entityId);
    }
}
