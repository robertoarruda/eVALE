<?php

namespace Nero\Evale\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nero\Evale\Http\Requests\CompanyFormRequest;
use Nero\Evale\Http\Requests\FillUpFormRequest;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;
use Nero\Evale\Services\FillUpService;
use Nero\Evale\Services\FuelTypeService;

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
        FuelTypeService $fuelTypeService,
        FillUpService $fillUpService
    ) {
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
        $this->fuelTypeService = $fuelTypeService;
        $this->fillUpService = $fillUpService;
    }

    /**
     * Index
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = $this->companyService->find([], 'complete');

        $data = [
            'companies' => $companies,
            'companiesCount' => $companies->count() ?: 0,
            'totalConsumption' => $this->fillUpService->filter()->sum('value'),
            'subscriptionsTotal' => $companies->sum('subscription_limit') ?: 0,
        ];

        return view('admin.index', $data);
    }

    /**
     * Create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company');
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

        return view('admin.company', $data->toArray());
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
            'fuel_types' => $this->fuelTypeService->find(),
            'companies' => $this->companyService->find(),
        ];

        return view('admin.fillup', $data);
    }

    /**
     * Abastecimento
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function postFillUp(FillUpFormRequest $request)
    {
        $this->fillUpService->post($request->all());

        return redirect()->route('admin.reports')
            ->with('success', 'Abastecimento lançado com sucesso!');
    }

    /**
     * Relatorios
     * @return \Illuminate\Http\Response
     */
    public function reports(Request $request)
    {
        $companyId = $request->query('filter_company') ?: 0;
        $initial = $request->query('filter_initial') ?: '';
        $final = $request->query('filter_final') ?: '';

        $fillUps = $this->fillUpService->filter($companyId, 0, $initial, $final);

        $data = [
            'fillUps' => $fillUps->sortByDesc('created_at'),
            'fillUpsCount' => $fillUps->count() ?: 0,
            'totalConsumption' => $fillUps->sum('value') ?? 0,
            'filter' => [
                'companies' => $this->companyService->find(),
                'initial' => $this->fillUpService->startOfMonth(),
                'final' => $this->fillUpService->endOfMonth(),
            ],
        ];

        return view('admin.reports', $data);
    }
}
