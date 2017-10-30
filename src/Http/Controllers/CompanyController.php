<?php

namespace Nero\Evale\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nero\Evale\Http\Requests\EmployeeFormRequest;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;

class CompanyController extends Controller
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
        $companyId = $request->user()->id ?? 0;

        $remainingSubscription = $this->companyService->remainingSubscription($companyId);

        $index = [
            'list' => $this->employeeService->find(['company_id' => $companyId]),
            'employeesCount' => $this->employeeService->count(['company_id' => $companyId]) ?: 0,
            'remainingSubscription' => number_format($remainingSubscription, 2, ',', '.'),
        ];

        return view('company.index', $index);
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

        $this->employeeService->create($request->all());

        return redirect()->route('company.index')
            ->with('success', 'Registro salvo com sucesso!');
    }

    /**
     * Show
     * @param int $employeeId Id do funcionario
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function show(int $employeeId)
    {
        return redirect()->route('company.edit', $employeeId);
    }

    /**
     * Edit
     * @param int $employeeId Id do funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $employeeId)
    {
        $params = [
            'id' => $employeeId,
            'company_id' => $request->user()->id ?? 0,
        ];

        $data = $this->employeeService->find($params)->first();

        return view('company.form', $data->toArray());
    }

    /**
     * Update
     * @param Request $request
     * @param int $employeeId Id do funcionario
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(EmployeeFormRequest $request, int $employeeId)
    {
        $request->merge(['company_id' => $request->user()->id ?? 0]);

        $this->employeeService->update($employeeId, $request->all());

        return redirect()->route('company.index')
            ->with('success', 'Registro alterado com sucesso!');
    }

    /**
     * Destroy
     * @param int $employeeId Id do funcionario
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(int $employeeId)
    {
        $this->employeeService->delete($employeeId);

        return redirect()->route('company.index')
            ->with('success', 'Registro excluido com sucesso!');
    }
}
