<?php

namespace Nero\Evale\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nero\Evale\Http\Requests\CompanyFormRequest;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;

class AdminController extends Controller
{
    /**
     * @var \Nero\Evale\Services\CompanyService
     */
    protected $companyService;

    /**
     * @var \Nero\Evale\Services\EmployeeService
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
     * @param int $companyId Id da empresa
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function show(int $companyId)
    {
        return redirect()->route('admin.edit', $companyId);
    }

    /**
     * Edit
     * @param int $companyId Id da empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(int $companyId)
    {
        $data = $this->companyService->findById($companyId);

        return view('admin.form', $data->toArray());
    }

    /**
     * Update
     * @param Request $request
     * @param int $companyId Id da empresa
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(CompanyFormRequest $request, int $companyId)
    {
        $this->companyService->update($companyId, $request->all());

        return redirect()->route('admin.index')
            ->with('success', 'Registro alterado com sucesso!');
    }

    /**
     * Destroy
     * @param int $companyId Id da empresa
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(int $companyId)
    {
        $this->companyService->delete($companyId);

        return redirect()->route('admin.index')
            ->with('success', 'Registro excluido com sucesso!');
    }

    /**
     * Abastecimento
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function fillUp()
    {
        $data = [
            'companies' => $this->companyService->find(),
        ];

        return view('admin.fillup', $data);
    }

    /**
     * Abastecimento
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function postFillUp()
    {
    }
}
