<?php

namespace Nero\ValeExpress\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nero\ValeExpress\Http\Requests\EmployeeFormRequest;
use Nero\ValeExpress\Services\EmployeeService;

class CompanyController extends Controller
{
    /**
     * @var \Nero\ValeExpress\Services\EmployeeService
     */
    protected $service;

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
     * Index
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = ['company_id' => $request->user()->id ?? 0];

        return view('company.index', $this->service->index($params));
    }

    /**
     * Create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.form');
    }

    /**
     * Store
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(EmployeeFormRequest $request)
    {
        $request->merge(['company_id' => $request->user()->id ?? 0]);

        $this->service->create($request->all());

        return redirect()->route('company.index')
            ->with('success', 'Registro salvo com sucesso!');
    }

    /**
     * Show
     * @param int $entityId Id da entidade
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function show(int $entityId)
    {
        return redirect()->route('company.edit', $entityId);
    }

    /**
     * Edit
     * @param int $entityId Id da entidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $entityId)
    {
        $params = [
            'id' => $entityId,
            'company_id' => $request->user()->id ?? 0,
        ];

        $data = $this->service->find($params)->first();

        return view('company.form', $data->toArray());
    }

    /**
     * Update
     * @param Request $request
     * @param int $entityId Id da entidade
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeFormRequest $request, int $entityId)
    {
        $request->merge(['company_id' => $request->user()->id ?? 0]);

        $this->service->update($entityId, $request->all());

        return redirect()->route('company.index')
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

        return redirect()->route('company.index')
            ->with('success', 'Registro excluido com sucesso!');
    }
}
