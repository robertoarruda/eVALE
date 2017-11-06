<?php

namespace Nero\Evale\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nero\Evale\Http\Requests\EmployeeFormRequest;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;
use Nero\Evale\Services\FillUpService;

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
     * @var \Nero\Evale\Services\FillUpService
     */
    protected $fillUpService;

    /**
     * Metodo construtor da classe
     * @return void
     */
    public function __construct(
        CompanyService $companyService,
        EmployeeService $employeeService,
        FillUpService $fillUpService
    ) {
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
        $this->fillUpService = $fillUpService;
    }

    /**
     * Index
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companyId = $request->user()->id ?? 0;

        $employees = $this->employeeService->findByCompanyId($companyId, 'complete');

        $index = [
            'employees' => $employees,
            'employeesCount' => $employees->count() ?: 0,
            'totalConsumption' => $this->fillUpService->filter($companyId)->sum('value') ?? 0,
            'remainingSubscription' => $this->companyService->remainingSubscription($companyId),
        ];

        return view('company.index', $index);
    }

    /**
     * Create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.employee');
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

        return view('company.employee', $data->toArray());
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

    /**
     * Relatorios
     * @return \Illuminate\Http\Response
     */
    public function reports(Request $request)
    {
        $companyId = $request->user()->id ?? 0;
        $employeeId = $request->query('filter_employee') ?: 0;
        $initial = $request->query('filter_initial') ?: '';
        $final = $request->query('filter_final') ?: '';

        $fillUps = $this->fillUpService->filter($companyId, $employeeId, $initial, $final);

        $index = [
            'fillUps' => $fillUps->sortByDesc('created_at'),
            'fillUpsCount' => $fillUps->count() ?: 0,
            'totalConsumption' => $fillUps->sum('value') ?? 0,
            'filter' => [
                'employees' => $this->employeeService->findByCompanyId($companyId),
                'initial' => $this->fillUpService->startOfMonth(),
                'final' => $this->fillUpService->endOfMonth(),
            ],
        ];

        return view('company.reports', $index);
    }

}
