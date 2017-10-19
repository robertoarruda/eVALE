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
            ->with()
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            ['list' => $company],
            $this->testedClass->index()
        );
    }
}
