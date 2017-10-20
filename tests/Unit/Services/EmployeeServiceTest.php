<?php

namespace Tests\Nero\ValeExpress\Services;

use Mockery;
use Nero\ValeExpress\Models\Employee;
use Nero\ValeExpress\Repositories\EmployeeRepository;
use Nero\ValeExpress\Services\EmployeeService;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\ValeExpress\Services\EmployeeService
 */
class EmployeeServiceTest extends TestCase
{
    protected $testedClassName = EmployeeService::class;

    public function setUp()
    {
        $this->dependencies = [
            'employeeRepository' => Mockery::mock(EmployeeRepository::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new EmployeeService(...array_values($this->dependencies));

        $this->assertInstanceOf(EmployeeService::class, $testedClass);
    }

    /**
     * @covers ::index
     */
    public function testIndex()
    {
        $employee = factory(Employee::class)->make();

        $this->dependencies['employeeRepository']
            ->shouldReceive('find')
            ->with([])
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            ['list' => $employee],
            $this->testedClass->index()
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $employee = factory(Employee::class)->make();

        $this->dependencies['employeeRepository']
            ->shouldReceive('create')
            ->with($employee->toArray())
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->create($employee->toArray())
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $employee = factory(Employee::class)->make(['id' => 1]);

        $this->dependencies['employeeRepository']
            ->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $employee = factory(Employee::class)->make(['id' => 1]);

        $this->dependencies['employeeRepository']
            ->shouldReceive('update')
            ->with(1, $employee->toArray())
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->update(1, $employee->toArray())
        );
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $employee = Mockery::mock(Employee::class);

        $this->dependencies['employeeRepository']
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->delete(1)
        );
    }
}
