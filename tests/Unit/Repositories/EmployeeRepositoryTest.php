<?php

namespace Tests\Nero\Evale\Repositories;

use Mockery;
use Nero\Evale\Models\Employee;
use Nero\Evale\Repositories\EmployeeRepository;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Repositories\EmployeeRepository
 */
class EmployeeRepositoryTest extends TestCase
{
    protected $testedClassName = EmployeeRepository::class;

    public function setUp()
    {
        $this->dependencies = [
            Employee::class => Mockery::mock(Employee::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new EmployeeRepository(...array_values($this->dependencies));

        $this->assertInstanceOf(EmployeeRepository::class, $testedClass);
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $employee = factory(Employee::class, 1)->make();

        $this->dependencies[Employee::class]
            ->shouldReceive('where->get')
            ->with(['id' => 1])
            ->with()
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
        $employee = factory(Employee::class)->make();

        $this->dependencies[Employee::class]
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $employee = factory(Employee::class)->make();

        $this->dependencies[Employee::class]
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
     * @covers ::update
     */
    public function testUpdate()
    {
        $employee = factory(Employee::class)->make();

        $this->dependencies[Employee::class]
            ->shouldReceive('where->first->fill->save')
            ->with('id', 1)
            ->with()
            ->with($employee->toArray())
            ->with()
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
        $this->dependencies[Employee::class]
            ->shouldReceive('where->delete')
            ->with('id', 1)
            ->with()
            ->once()
            ->andReturn($this->dependencies[Employee::class]);

        $this->assertInstanceOf(
            Employee::class,
            $this->testedClass->delete(1)
        );
    }
}
