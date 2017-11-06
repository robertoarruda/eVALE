<?php

namespace Tests\Nero\Evale\Services;

use Carbon\Carbon;
use Mockery;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\Employee;
use Nero\Evale\Models\FillUp;
use Nero\Evale\Repositories\CompanyRepository;
use Nero\Evale\Services\CompanyService;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Services\CompanyService
 */
class CompanyServiceTest extends TestCase
{
    protected $testedClassName = CompanyService::class;

    public function setUp()
    {
        $this->dependencies = [
            CompanyRepository::class => Mockery::mock(CompanyRepository::class),
            Carbon::class => new Carbon(),
        ];

        parent::setUp();
    }

    protected function pushFillUpsInCompany(Company $company)
    {
        $company->fillUps = factory(FillUp::class, 10)
            ->make([
                'value' => 10,
                'created_at' => $this->dependencies[Carbon::class]->now(),
            ]);

        $company->fillUps->push(
            factory(FillUp::class)
                ->make([
                    'value' => 100,
                    'created_at' => $this->dependencies[Carbon::class]->now()->addMonths(1),
                ])
        );

        $company->fillUps->push(
            factory(FillUp::class)
                ->make([
                    'value' => 100,
                    'created_at' => $this->dependencies[Carbon::class]->now()->subMonths(1),
                ])
        );

        return $company;
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new CompanyService(...array_values($this->dependencies));

        $this->assertInstanceOf(CompanyService::class, $testedClass);
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $company = factory(Company::class)->make();

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('create')
            ->with($company->toArray())
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->create($company->toArray())
        );
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $companies = factory(Company::class, 1)->make(['id' => 1]);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1])
            ->once()
            ->andReturn($companies);

        $this->assertEquals(
            $companies,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::find
     */
    public function testFindComplete()
    {
        $companies = factory(Company::class, 10)->make(['id' => 1]);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('find')
            ->with([])
            ->once()
            ->andReturn($companies);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('findById')
            ->times(10);

        $this->assertEquals(
            $companies,
            $this->testedClass->find([], 'complete')
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $company = factory(Company::class)->make(['id' => 1]);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $company = factory(Company::class)->make(['id' => 1]);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('update')
            ->with(1, $company->toArray())
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->update(1, $company->toArray())
        );
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $company = Mockery::mock(Company::class);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->delete(1)
        );
    }

    /**
     * @covers ::remainingSubscription
     */
    public function testRemainingSubscription()
    {
        $company = factory(Company::class)->make(['id' => 1, 'subscription_limit' => 60]);
        $company->employees = factory(Employee::class, 5)->make(['consumption_limit' => 10]);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($company);

        $this->assertEquals(10, $this->testedClass->remainingSubscription(1));
    }

    /**
     * @covers ::consumption
     */
    public function testConsumption()
    {
        $companyId = 10;
        $company = factory(Company::class)->make();
        $company = $this->pushFillUpsInCompany($company);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('findById')
            ->with($companyId)
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            100.00,
            $this->testedClass->consumption($companyId)
        );
    }

    /**
     * @covers ::consumption
     */
    public function testConsumptionWithDates()
    {
        $companyId = 10;
        $company = factory(Company::class)->make();
        $company = $this->pushFillUpsInCompany($company);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('findById')
            ->with($companyId)
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            300.00,
            $this->testedClass->consumption(
                $companyId,
                $this->dependencies[Carbon::class]->now()->subMonths(1)->toDateString(),
                $this->dependencies[Carbon::class]->now()->addMonths(1)->toDateString()
            )
        );
    }

    /**
     * @covers ::consumption
     */
    public function testConsumptionEmptyCompany()
    {
        $companyId = 10;

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('findById')
            ->with($companyId)
            ->once();

        $this->assertEquals(
            0,
            $this->testedClass->consumption($companyId)
        );
    }

}
