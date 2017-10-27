<?php

namespace Tests\Nero\Evale\Repositories;

use Mockery;
use Nero\Evale\Models\Company;
use Nero\Evale\Repositories\CompanyRepository;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Repositories\CompanyRepository
 */
class CompanyRepositoryTest extends TestCase
{
    protected $testedClassName = CompanyRepository::class;

    public function setUp()
    {
        $this->dependencies = [
            'company' => Mockery::mock(Company::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new CompanyRepository(...array_values($this->dependencies));

        $this->assertInstanceOf(CompanyRepository::class, $testedClass);
    }

    /**
     * @covers ::count
     */
    public function testCount()
    {
        $company = factory(Company::class, 1)->make();

        $this->dependencies['company']
            ->shouldReceive('where->count')
            ->with(['id' => 1])
            ->with()
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->count(['id' => 1])
        );
    }

    /**
     * @covers ::sum
     */
    public function testSum()
    {
        $company = factory(Company::class, 1)->make();

        $this->dependencies['company']
            ->shouldReceive('where->sum')
            ->with(['id' => 1])
            ->with('field')
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->sum('field', ['id' => 1])
        );
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $company = factory(Company::class, 1)->make();

        $this->dependencies['company']
            ->shouldReceive('where->get')
            ->with(['id' => 1])
            ->with()
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
        $company = factory(Company::class)->make();

        $this->dependencies['company']
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            $company,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $company = factory(Company::class)->make();

        $this->dependencies['company']
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
     * @covers ::update
     */
    public function testUpdate()
    {
        $company = factory(Company::class)->make();

        $this->dependencies['company']
            ->shouldReceive('where->first->fill->save')
            ->with('id', 1)
            ->with()
            ->with($company->toArray())
            ->with()
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
        $this->dependencies['company']
            ->shouldReceive('where->delete')
            ->with('id', 1)
            ->with()
            ->once()
            ->andReturn($this->dependencies['company']);

        $this->assertInstanceOf(
            Company::class,
            $this->testedClass->delete(1)
        );
    }
}
