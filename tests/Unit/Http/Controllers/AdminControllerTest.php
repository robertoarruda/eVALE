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
use Nero\Evale\Services\FillUpService;
use Nero\Evale\Services\FuelTypeService;
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
            FuelTypeService::class => Mockery::mock(FuelTypeService::class),
            FillUpService::class => Mockery::mock(FillUpService::class),
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
        $subscriptionLimit = 1000;
        $subscriptionsTotal = $subscriptionLimit * $companiesCount;

        $fillUpCount = 5;
        $consumption = 100;
        $totalConsumption = $consumption * $fillUpCount;

        $companies = factory(Company::class, $companiesCount)
            ->make(['subscription_limit' => $subscriptionLimit]);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('find')
            ->with()
            ->once()
            ->andReturn($companies);

        $fillUp = factory(Company::class, $fillUpCount)
            ->make(['value' => $consumption]);

        $this->dependencies[FillUpService::class]
            ->shouldReceive('filter')
            ->with()
            ->once()
            ->andReturn($fillUp);

        $index = [
            'companies' => $companies,
            'companiesCount' => $companiesCount,
            'totalConsumption' => $totalConsumption,
            'subscriptionsTotal' => $subscriptionsTotal,
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
            ->with('admin.company', [], [])
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
        $companyId = 1;

        $company = factory(Company::class)->make();
        $this->dependencies[CompanyService::class]
            ->shouldReceive('findById')
            ->with($companyId)
            ->once()
            ->andReturn($company);

        View::shouldReceive('make')
            ->with('admin.company', $company->toArray(), [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->edit($companyId)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $companyId = 1;

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
            ->with($companyId, $request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->update($this->otherDependencies[CompanyFormRequest::class], $companyId)
        );
    }

    /**
     * @covers ::destroy
     */
    public function testDestroy()
    {
        $companyId = 1;

        $this->dependencies[CompanyService::class]
            ->shouldReceive('delete')
            ->with($companyId)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->destroy($companyId)
        );
    }
}
