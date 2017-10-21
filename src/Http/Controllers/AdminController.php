<?php

namespace Nero\ValeExpress\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nero\ValeExpress\Http\Requests\CompanyFormRequest;
use Nero\ValeExpress\Services\CompanyService;

class AdminController extends Controller
{
    /**
     * @var \Nero\ValeExpress\Services\CompanyService
     */
    protected $service;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    /**
     * Index
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.index', $this->service->index());
    }

    /**
     * Create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.form');
    }

    /**
     * Store
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(CompanyFormRequest $request)
    {
        $this->service->create($request->all());

        return redirect()->route('admin.index')
            ->with('success', 'Registro salvo com sucesso!');
    }

    /**
     * Show
     * @param int $entityId Id da entidade
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function show(int $entityId)
    {
        return redirect()->route('admin.edit', $entityId);
    }

    /**
     * Edit
     * @param int $entityId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $entityId)
    {
        $data = $this->service->findById($entityId);

        return view('admin.form', $data->toArray());
    }

    /**
     * Update
     * @param Request $request
     * @param int $entityId Id da entidade
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(CompanyFormRequest $request, int $entityId)
    {
        $this->service->update($entityId, $request->all());

        return redirect()->route('admin.index')
            ->with('success', 'Registro alterado com sucesso!');
    }

    /**
     * Destroy
     * @param int $entityId Id da entidade
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(int $entityId)
    {
        $this->service->delete($entityId);

        return redirect()->route('admin.index')
            ->with('success', 'Registro excluido com sucesso!');
    }
}
