<?php

namespace Tests\Nero\ValeExpress\Services;

use Mockery;
use Nero\ValeExpress\Models\Company;
use Nero\ValeExpress\Repositories\CompanyRepository;
use Nero\ValeExpress\Services\CompanyService;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\ValeExpress\Services\CompanyService
 */
class CompanyServiceTest extends TestCase
{
    protected $testedClassName = CompanyService::class;

    public function setUp()
    {
        $this->dependencies = [
            'companyRepository' => Mockery::mock(CompanyRepository::class),
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
     * @covers ::index
     */
    public function testIndex()
    {
        $company = factory(Company::class)->make();

        $this->dependencies['companyRepository']
            ->shouldReceive('find')
            ->with([])
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            ['list' => $company],
            $this->testedClass->index()
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $company = factory(Company::class)->make();

        $this->dependencies['companyRepository']
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
     * @covers ::findById
     */
    public function testFindById()
    {
        $company = factory(Company::class)->make(['id' => 1]);

        $this->dependencies['companyRepository']
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

        $this->dependencies['companyRepository']
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

        $this->dependencies['companyRepository']
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
