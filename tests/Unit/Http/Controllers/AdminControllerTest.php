<?php

namespace Tests\Nero\Evale\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery;
use Nero\Evale\Http\Controllers\AdminController;
use Nero\Evale\Http\Requests\CompanyFormRequest;
use Nero\Evale\Models\Company;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;
use Tests\TestCase;
use View;

/**
 * @coversDefaultClass \Nero\Evale\Http\Controllers\AdminController
 */
class AdminControllerTest extends TestCase
{
    protected $testedClassName = AdminController::class;

    public function setUp()
    {
        $this->otherDependencies = [
            Request::class => Mockery::mock(Request::class),
            Response::class => Mockery::mock(Response::class),
            CompanyFormRequest::class => Mockery::mock(CompanyFormRequest::class),
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
        $testedClass = new AdminController(...array_values($this->dependencies));

        $this->assertInstanceOf(AdminController::class, $testedClass);
    }

    /**
     * @covers ::index
     */
    public function testIndex()
    {
        $companiesCount = 10;
        $employeesCount = 100;
        $subscriptionLimit = 1000;
        $subscriptionsTotal = $subscriptionLimit * $companiesCount;

        $companies = factory(Company::class, $companiesCount)
            ->make(['subscription_limit' => $subscriptionLimit]);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('find')
            ->with()
            ->once()
            ->andReturn($companies);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('sum')
            ->with('subscription_limit')
            ->once()
            ->andReturn($subscriptionsTotal);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('count')
            ->with()
            ->once()
            ->andReturn($companiesCount);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('count')
            ->with()
            ->once()
            ->andReturn($employeesCount);

        $index = [
            'list' => $companies,
            'companiesCount' => $companiesCount,
            'employeesCount' => $employeesCount,
            'subscriptionsTotal' => number_format($subscriptionsTotal, 2, ',', '.'),
        ];

        View::shouldReceive('make')
            ->with('admin.index', $index, [])
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
            ->with('admin.form', [], [])
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
        $request = factory(Company::class)
            ->make()
            ->toArray();

        $this->otherDependencies[CompanyFormRequest::class]
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('create')
            ->with($request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->store($this->otherDependencies[CompanyFormRequest::class])
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

        $company = factory(Company::class)->make();
        $this->dependencies[CompanyService::class]
            ->shouldReceive('findById')
            ->with($entityId)
            ->once()
            ->andReturn($company);

        View::shouldReceive('make')
            ->with('admin.form', $company->toArray(), [])
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

        $this->otherDependencies[CompanyFormRequest::class]
            ->shouldReceive('merge')
            ->with()
            ->once();

        $request = factory(Company::class)
            ->make()
            ->toArray();

        $this->otherDependencies[CompanyFormRequest::class]
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('update')
            ->with($entityId, $request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->update($this->otherDependencies[CompanyFormRequest::class], $entityId)
        );
    }

    /**
     * @covers ::destroy
     */
    public function testDestroy()
    {
        $entityId = 1;

        $this->dependencies[CompanyService::class]
            ->shouldReceive('delete')
            ->with($entityId)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->destroy($entityId)
        );
    }
}
