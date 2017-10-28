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
            'request' => Mockery::mock(Request::class),
            'response' => Mockery::mock(Response::class),
            'employeeFormRequest' => Mockery::mock(EmployeeFormRequest::class),
        ];

        $this->dependencies = [
            'companyService' => Mockery::mock(CompanyService::class),
            'employeeService' => Mockery::mock(EmployeeService::class),
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
        $this->otherDependencies['request']
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($user);

        $companies = factory(Company::class, $employeesCount)
            ->make(['subscription_limit' => $subscriptionLimit]);

        $this->dependencies['companyService']
            ->shouldReceive('find')
            ->with(['id' => $user->id])
            ->once()
            ->andReturn($companies);

        $this->dependencies['companyService']
            ->shouldReceive('remainingSubscription')
            ->with($user->id)
            ->once()
            ->andReturn($remainingSubscription);

        $this->dependencies['employeeService']
            ->shouldReceive('find')
            ->with(['company_id' => $user->id])
            ->once()
            ->andReturn($companies);

        $this->dependencies['employeeService']
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
            ->andReturn($this->otherDependencies['response']);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->index($this->otherDependencies['request'])
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
            ->andReturn($this->otherDependencies['response']);

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
        $this->otherDependencies['employeeFormRequest']
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($user);

        $this->otherDependencies['employeeFormRequest']
            ->shouldReceive('merge')
            ->with(['company_id' => $user->id])
            ->once();

        $request = factory(Company::class)
            ->make(['company_id' => $user->id])
            ->toArray();

        $this->otherDependencies['employeeFormRequest']
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies['employeeService']
            ->shouldReceive('create')
            ->with($request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->store($this->otherDependencies['employeeFormRequest'])
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
        $this->otherDependencies['request']
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($user);

        $params = [
            'id' => $entityId,
            'company_id' => $user->id,
        ];

        $employee = factory(Employee::class, 1)->make();
        $this->dependencies['employeeService']
            ->shouldReceive('find')
            ->with($params)
            ->once()
            ->andReturn($employee);

        View::shouldReceive('make')
            ->with('company.form', $employee->first()->toArray(), [])
            ->once()
            ->andReturn($this->otherDependencies['response']);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->edit($this->otherDependencies['request'], $entityId)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $entityId = 1;

        $user = factory(User::class)->make(['id' => 1]);
        $this->otherDependencies['employeeFormRequest']
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($user);

        $this->otherDependencies['employeeFormRequest']
            ->shouldReceive('merge')
            ->with(['company_id' => $user->id])
            ->once();

        $request = factory(Company::class)
            ->make(['company_id' => $user->id])
            ->toArray();

        $this->otherDependencies['employeeFormRequest']
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies['employeeService']
            ->shouldReceive('update')
            ->with($entityId, $request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->update($this->otherDependencies['employeeFormRequest'], $entityId)
        );
    }

    /**
     * @covers ::destroy
     */
    public function testDestroy()
    {
        $entityId = 1;

        $this->dependencies['employeeService']
            ->shouldReceive('delete')
            ->with($entityId)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->destroy($entityId)
        );
    }
}
