<?php

namespace Nero\ValeExpress\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nero\ValeExpress\Http\Requests\CompanyFormRequest;
use Nero\ValeExpress\Services\CompanyService;
use Nero\ValeExpress\Services\EmployeeService;

class AdminController extends Controller
{
    /**
     * @var \Nero\ValeExpress\Services\CompanyService
     */
    protected $companyService;

    /**
     * @var \Nero\ValeExpress\Services\EmployeeService
     */
    protected $employeeService;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(
        CompanyService $companyService,
        EmployeeService $employeeService
    ) {
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
    }

    /**
     * Index
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subscriptionsTotal = $this->companyService->sum('subscription_limit') ?: 0;

        $index = [
            'list' => $this->companyService->find(),
            'companiesCount' => $this->companyService->count() ?: 0,
            'employeesCount' => $this->employeeService->count() ?: 0,
            'subscriptionsTotal' => number_format($subscriptionsTotal, 2, ',', '.'),
        ];

        return view('admin.index', $index);
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
        $this->companyService->create($request->all());

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
        $data = $this->companyService->findById($entityId);

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
        $this->companyService->update($entityId, $request->all());

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
        $this->companyService->delete($entityId);

        return redirect()->route('admin.index')
            ->with('success', 'Registro excluido com sucesso!');
    }
}
