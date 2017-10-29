<?php

namespace Tests\Nero\Evale\Services;

use Mockery;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\Employee;
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
        ];

        parent::setUp();
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
     * @covers ::count
     */
    public function testCount()
    {
        $company = factory(Company::class)->make();

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('count')
            ->with($company->toArray())
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->count($company->toArray())
        );
    }

    /**
     * @covers ::sum
     */
    public function testSum()
    {
        $company = factory(Company::class)->make();

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('sum')
            ->with('field', $company->toArray())
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->sum('field', $company->toArray())
        );
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
        $company = factory(Company::class)->make(['id' => 1]);

        $this->dependencies[CompanyRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1])
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->find(['id' => 1])
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
}
