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
use Nero\Evale\Models\User;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;
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
        $subscriptionLimit = 1000.99;
        $totalConsumptionLimit = 559.80;
        $remainingSubscription = $subscriptionLimit - $totalConsumptionLimit;

        $user = factory(User::class)->make(['id' => 1]);
        $this->otherDependencies[Request::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($user);

        $companies = factory(Company::class, $employeesCount)
            ->make(['subscription_limit' => $subscriptionLimit]);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('find')
            ->with(['id' => $user->id])
            ->once()
            ->andReturn($companies);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($user->id)
            ->once()
            ->andReturn($remainingSubscription);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with(['company_id' => $user->id])
            ->once()
            ->andReturn($companies);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('count')
            ->with(['company_id' => $user->id])
            ->once()
            ->andReturn($employeesCount);

        $index = [
            'list' => $companies,
            'employeesCount' => $employeesCount,
            'remainingSubscription' => number_format($remainingSubscription, 2, ',', '.'),
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
            ->with('company.form', [], [])
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
        $user = factory(User::class)->make(['id' => 1]);
        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($user);

        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('merge')
            ->with(['company_id' => $user->id])
            ->once();

        $request = factory(Company::class)
            ->make(['company_id' => $user->id])
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
        $entityId = 1;

        $user = factory(User::class)->make(['id' => 1]);
        $this->otherDependencies[Request::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($user);

        $params = [
            'id' => $entityId,
            'company_id' => $user->id,
        ];

        $employee = factory(Employee::class, 1)->make();
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with($params)
            ->once()
            ->andReturn($employee);

        View::shouldReceive('make')
            ->with('company.form', $employee->first()->toArray(), [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->edit($this->otherDependencies[Request::class], $entityId)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $entityId = 1;

        $user = factory(User::class)->make(['id' => 1]);
        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($user);

        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('merge')
            ->with(['company_id' => $user->id])
            ->once();

        $request = factory(Company::class)
            ->make(['company_id' => $user->id])
            ->toArray();

        $this->otherDependencies[EmployeeFormRequest::class]
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('update')
            ->with($entityId, $request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->update($this->otherDependencies[EmployeeFormRequest::class], $entityId)
        );
    }

    /**
     * @covers ::destroy
     */
    public function testDestroy()
    {
        $entityId = 1;

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('delete')
            ->with($entityId)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->destroy($entityId)
        );
    }
}
