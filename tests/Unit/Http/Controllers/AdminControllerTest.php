<?php

namespace Tests\Nero\Evale\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery;
use Nero\Evale\Http\Controllers\AdminController;
use Nero\Evale\Http\Requests\CompanyFormRequest;
use Nero\Evale\Http\Requests\FillUpFormRequest;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\FillUp;
use Nero\Evale\Models\FuelType;
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
            FillUpFormRequest::class => Mockery::mock(FillUpFormRequest::class),
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
            ->with([], 'complete')
            ->once()
            ->andReturn($companies);

        $fillUp = factory(Company::class, $fillUpCount)
            ->make(['value' => $consumption]);

        $this->dependencies[FillUpService::class]
            ->shouldReceive('filter')
            ->with()
            ->once()
            ->andReturn($fillUp);

        $data = [
            'companies' => $companies,
            'companiesCount' => $companiesCount,
            'totalConsumption' => $totalConsumption,
            'subscriptionsTotal' => $subscriptionsTotal,
        ];

        View::shouldReceive('make')
            ->with('admin.index', $data, [])
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

    /**
     * @covers ::fillUp
     */
    public function testFillUp()
    {
        $companyId = 1;

        $fuelTypes = factory(FuelType::class, 5)->make();
        $this->dependencies[FuelTypeService::class]
            ->shouldReceive('find')
            ->with()
            ->once()
            ->andReturn($fuelTypes);

        $companies = factory(Company::class, 10)->make();
        $this->dependencies[CompanyService::class]
            ->shouldReceive('find')
            ->with()
            ->once()
            ->andReturn($companies);

        $data = [
            'fuel_types' => $fuelTypes,
            'companies' => $companies,
        ];

        View::shouldReceive('make')
            ->with('admin.fillup', $data, [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->fillUp($companyId)
        );
    }

    /**
     * @covers ::postFillUp
     */
    public function testPostFillUp()
    {
        $request = factory(FillUp::class)
            ->make()
            ->toArray();

        $this->otherDependencies[FillUpFormRequest::class]
            ->shouldReceive('all')
            ->with()
            ->once()
            ->andReturn($request);

        $this->dependencies[FillUpService::class]
            ->shouldReceive('post')
            ->with($request)
            ->once();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->postFillUp($this->otherDependencies[FillUpFormRequest::class])
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

        $companyId = 10;
        $this->otherDependencies[Request::class]
            ->shouldReceive('query')
            ->with('filter_company')
            ->once()
            ->andReturn($companyId);

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
            ->with($companyId, 0, '', '')
            ->once()
            ->andReturn($fillUps);

        $companies = factory(Company::class, 10)->make();
        $this->dependencies[CompanyService::class]
            ->shouldReceive('find')
            ->with()
            ->once()
            ->andReturn($companies);

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
                'companies' => $companies,
                'initial' => $startOfMonth,
                'final' => $endOfMonth,
            ],
        ];

        View::shouldReceive('make')
            ->with('admin.reports', $data, [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->reports($this->otherDependencies[Request::class])
        );
    }
}
