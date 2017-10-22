<?php

namespace Tests\Nero\ValeExpress\Repositories;

use Mockery;
use Nero\ValeExpress\Models\Employee;
use Nero\ValeExpress\Repositories\EmployeeRepository;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\ValeExpress\Repositories\EmployeeRepository
 */
class EmployeeRepositoryTest extends TestCase
{
    protected $testedClassName = EmployeeRepository::class;

    public function setUp()
    {
        $this->dependencies = [
            'employee' => Mockery::mock(Employee::class),
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
     * @covers ::count
     */
    public function testCount()
    {
        $employee = factory(Employee::class, 1)->make();

        $this->dependencies['employee']
            ->shouldReceive('where->count')
            ->with(['id' => 1])
            ->with()
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->count(['id' => 1])
        );
    }

    /**
     * @covers ::sum
     */
    public function testSum()
    {
        $employee = factory(Employee::class, 1)->make();

        $this->dependencies['employee']
            ->shouldReceive('where->sum')
            ->with(['id' => 1])
            ->with('field')
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->sum('field', ['id' => 1])
        );
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $employee = factory(Employee::class, 1)->make();

        $this->dependencies['employee']
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

        $this->dependencies['employee']
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

        $this->dependencies['employee']
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

        $this->dependencies['employee']
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
        $this->dependencies['employee']
            ->shouldReceive('where->delete')
            ->with('id', 1)
            ->with()
            ->once()
            ->andReturn($this->dependencies['employee']);

        $this->assertInstanceOf(
            Employee::class,
            $this->testedClass->delete(1)
        );
    }
}
