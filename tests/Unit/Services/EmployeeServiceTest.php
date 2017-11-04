<?php

namespace Tests\Nero\Evale\Services;

use Carbon\Carbon;
use Mockery;
use Nero\Evale\Models\Employee;
use Nero\Evale\Repositories\EmployeeRepository;
use Nero\Evale\Services\EmployeeService;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Services\EmployeeService
 */
class EmployeeServiceTest extends TestCase
{
    protected $testedClassName = EmployeeService::class;

    public function setUp()
    {
        $this->dependencies = [
            EmployeeRepository::class => Mockery::mock(EmployeeRepository::class),
            Carbon::class => Mockery::mock(Carbon::class),
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
     * @covers ::count
     */
    public function testCount()
    {
        $employee = factory(Employee::class)->make();

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('count')
            ->with($employee->toArray())
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->count($employee->toArray())
        );
    }

    /**
     * @covers ::sum
     */
    public function testSum()
    {
        $employee = factory(Employee::class)->make();

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('sum')
            ->with('field', $employee->toArray())
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->sum('field', $employee->toArray())
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $employee = factory(Employee::class)->make();

        $this->dependencies[EmployeeRepository::class]
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
     * @covers ::find
     */
    public function testFind()
    {
        $employee = factory(Employee::class)->make(['id' => 1]);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1])
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $employee = factory(Employee::class)->make(['id' => 1]);

        $this->dependencies[EmployeeRepository::class]
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

        $this->dependencies[EmployeeRepository::class]
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

        $this->dependencies[EmployeeRepository::class]
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
