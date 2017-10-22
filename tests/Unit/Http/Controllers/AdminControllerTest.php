<?php

namespace Tests\Nero\ValeExpress\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery;
use Nero\ValeExpress\Http\Controllers\AdminController;
use Nero\ValeExpress\Http\Requests\CompanyFormRequest;
use Nero\ValeExpress\Models\Company;
use Nero\ValeExpress\Services\CompanyService;
use Nero\ValeExpress\Services\EmployeeService;
use Tests\TestCase;
use View;

/**
 * @coversDefaultClass \Nero\ValeExpress\Http\Controllers\AdminController
 */
class AdminControllerTest extends TestCase
{
    protected $testedClassName = AdminController::class;

    public function setUp()
    {
        $this->otherDependencies = [
            'request' => Mockery::mock(Request::class),
            'response' => Mockery::mock(Response::class),
            'companyFormRequest' => Mockery::mock(CompanyFormRequest::class),
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

        $this->dependencies['companyService']
            ->shouldReceive('find')
            ->with()
            ->once()
            ->andReturn($companies);

        $this->dependencies['companyService']
            ->shouldReceive('sum')
            ->with('subscription_limit')
            ->once()
            ->andReturn($subscriptionsTotal);

        $this->dependencies['companyService']
            ->shouldReceive('count')
            ->with()
            ->once()
            ->andReturn($companiesCount);

        $this->dependencies['employeeService']
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
            ->with('admin.form', [], [])
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
        $request = factory(Company::class)
            ->make()
            ->toArray();

        $this->otherDependencies['companyFormRequest']
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies['companyService']
            ->shouldReceive('create')
            ->with($request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->store($this->otherDependencies['companyFormRequest'])
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
        $this->dependencies['companyService']
            ->shouldReceive('findById')
            ->with($entityId)
            ->once()
            ->andReturn($company);

        View::shouldReceive('make')
            ->with('admin.form', $company->toArray(), [])
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

        $this->otherDependencies['companyFormRequest']
            ->shouldReceive('merge')
            ->with()
            ->once();

        $request = factory(Company::class)
            ->make()
            ->toArray();

        $this->otherDependencies['companyFormRequest']
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies['companyService']
            ->shouldReceive('update')
            ->with($entityId, $request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->update($this->otherDependencies['companyFormRequest'], $entityId)
        );
    }

    /**
     * @covers ::destroy
     */
    public function testDestroy()
    {
        $entityId = 1;

        $this->dependencies['companyService']
            ->shouldReceive('delete')
            ->with($entityId)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->destroy($entityId)
        );
    }
}
