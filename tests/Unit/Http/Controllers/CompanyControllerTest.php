<?php

namespace Tests\Nero\Evale\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery;
use Nero\Evale\Http\Controllers\CompanyController;
use Nero\Evale\Http\Requests\EmployeeFormRequest;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\Employee;
use Nero\Evale\Models\FillUp;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;
use Nero\Evale\Services\FillUpService;
use Tests\TestCase;
use View;

/**
 * @coversDefaultClass \Nero\Evale\Http\Controllers\CompanyController
 */
class CompanyControllerTest extends TestCase
{
    protected $testedClassName = CompanyController::class;

    public function setUp()
    {
        $this->otherDependencies = [
            Request::class => Mockery::mock(Request::class),
            Response::class => Mockery::mock(Response::class),
            EmployeeFormRequest::class => Mockery::mock(EmployeeFormRequest::class),
        ];

        $this->dependencies = [
            CompanyService::class => Mockery::mock(CompanyService::class),
            EmployeeService::class => Mockery::mock(EmployeeService::class),
            FillUpService::class => Mockery::mock(FillUpService::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new CompanyController(...array_values($this->dependencies));

        $this->assertInstanceOf(CompanyController::class, $testedClass);
    }

    /**
     * @covers ::index
     */
    public function testIndex()
    {
        $employeesCount = 10;
        $remainingSubscription = 10000;

        $fillUpCount = 5;
        $consumption = 100;
        $totalConsumption = $consumption * $fillUpCount;

        $company = factory(Company::class)->make(['id' => 1]);
        $this->otherDependencies[Request::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($company);

        $employees = factory(Employee::class, $employeesCount)->make();
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('findByCompanyId')
            ->with($company->id, 'complete')
            ->once()
            ->andReturn($employees);

        $fillUp = factory(FillUp::class, $fillUpCount)
            ->make(['value' => $consumption]);

        $this->dependencies[FillUpService::class]
            ->shouldReceive('filter')
            ->with($company->id)
            ->once()
            ->andReturn($fillUp);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($company->id)
            ->once()
            ->andReturn($remainingSubscription);

        $index = [
            'employees' => $employees,
            'employeesCount' => $employeesCount,
            'totalConsumption' => $totalConsumption,
            'remainingSubscription' => $remainingSubscription,
        ];

        View::shouldReceive('make')
            ->with('company.index', $index, [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->index($this->otherDependencies[Request::class])
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        View::shouldReceive('make')
            ->with('company.employee', [], [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->create()
        );
    }

    /**
     * @covers ::store
     */
    public function testStore()
    {
        $company = factory(Company::class)->make(['id' => 1]);
        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($company);

        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('merge')
            ->with(['company_id' => $company->id])
            ->once();

        $request = factory(Company::class)
            ->make(['company_id' => $company->id])
            ->toArray();

        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('create')
            ->with($request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->store($this->otherDependencies[EmployeeFormRequest::class])
        );
    }

    /**
     * @covers ::show
     */
    public function testShow()
    {
        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->show(1)
        );
    }

    /**
     * @covers ::edit
     */
    public function testEdit()
    {
        $employeeId = 1;

        $company = factory(Company::class)->make(['id' => 1]);
        $this->otherDependencies[Request::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($company);

        $params = [
            'id' => $employeeId,
            'company_id' => $company->id,
        ];

        $employee = factory(Employee::class, 1)->make();
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with($params)
            ->once()
            ->andReturn($employee);

        View::shouldReceive('make')
            ->with('company.employee', $employee->first()->toArray(), [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->edit($this->otherDependencies[Request::class], $employeeId)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $employeeId = 1;

        $company = factory(Company::class)->make(['id' => 1]);
        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($company);

        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('merge')
            ->with(['company_id' => $company->id])
            ->once();

        $request = factory(Company::class)
            ->make(['company_id' => $company->id])
            ->toArray();

        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('update')
            ->with($employeeId, $request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->update($this->otherDependencies[EmployeeFormRequest::class], $employeeId)
        );
    }

    /**
     * @covers ::destroy
     */
    public function testDestroy()
    {
        $employeeId = 1;

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('delete')
            ->with($employeeId)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->destroy($employeeId)
        );
    }

    /**
     * @covers ::reports
     */
    public function testReports()
    {
        $fillUpsCount = 10;
        $fillUpsValue = 10;
        $startOfMonth = '2017-11-01';
        $endOfMonth = '2017-11-30';

        $company = factory(Company::class)->make(['id' => 1]);
        $this->otherDependencies[Request::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($company);

        $employeeId = 10;
        $this->otherDependencies[Request::class]
            ->shouldReceive('query')
            ->with('filter_employee')
            ->once()
            ->andReturn($employeeId);

        $initial = '';
        $this->otherDependencies[Request::class]
            ->shouldReceive('query')
            ->with('filter_initial')
            ->once()
            ->andReturn($initial);

        $final = '';
        $this->otherDependencies[Request::class]
            ->shouldReceive('query')
            ->with('filter_final')
            ->once()
            ->andReturn($final);

        $fillUps = factory(FillUp::class, $fillUpsCount)->make(['value' => $fillUpsValue]);
        $this->dependencies[FillUpService::class]
            ->shouldReceive('filter')
            ->with($company->id, $employeeId, '', '')
            ->once()
            ->andReturn($fillUps);

        $employees = factory(Employee::class, 10)->make();
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('findByCompanyId')
            ->with($company->id)
            ->once()
            ->andReturn($employees);

        $this->dependencies[FillUpService::class]
            ->shouldReceive('startOfMonth')
            ->with()
            ->once()
            ->andReturn($startOfMonth);

        $this->dependencies[FillUpService::class]
            ->shouldReceive('endOfMonth')
            ->with()
            ->once()
            ->andReturn($endOfMonth);

        $data = [
            'fillUps' => $fillUps,
            'fillUpsCount' => $fillUpsCount,
            'totalConsumption' => $fillUpsCount * $fillUpsValue,
            'filter' => [
                'employees' => $employees,
                'initial' => $startOfMonth,
                'final' => $endOfMonth,
            ],
        ];

        View::shouldReceive('make')
            ->with('company.reports', $data, [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->reports($this->otherDependencies[Request::class])
        );
    }
}
