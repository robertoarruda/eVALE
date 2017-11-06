<?php

namespace Tests\Nero\Evale\Services;

use Carbon\Carbon;
use Mockery;
use Nero\Evale\Models\Employee;
use Nero\Evale\Models\FillUp;
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
            Carbon::class => new Carbon(),
        ];

        parent::setUp();
    }

    protected function pushFillUpsInEmployee(Employee $employee)
    {
        $employee->fillUps = factory(FillUp::class, 10)
            ->make([
                'value' => 10,
                'created_at' => $this->dependencies[Carbon::class]->now(),
            ]);

        $employee->fillUps->push(
            factory(FillUp::class)
                ->make([
                    'value' => 100,
                    'created_at' => $this->dependencies[Carbon::class]->now()->addMonths(1),
                ])
        );

        $employee->fillUps->push(
            factory(FillUp::class)
                ->make([
                    'value' => 100,
                    'created_at' => $this->dependencies[Carbon::class]->now()->subMonths(1),
                ])
        );

        return $employee;
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $employee = factory(Employee::class)->make(['id' => 1]);
        $testedClass = new EmployeeService(...array_values($this->dependencies));

        $this->assertInstanceOf(EmployeeService::class, $testedClass);
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
        $employees = factory(Employee::class, 1)->make(['id' => 1]);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1])
            ->once()
            ->andReturn($employees);

        $this->assertEquals(
            $employees,
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

    /**
     * @covers ::findByCompanyId
     */
    public function testFindByCompanyId()
    {
        $companyId = 10;
        $employee = factory(Employee::class, 10)->make(['company_id' => $companyId]);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('find')
            ->with(['company_id' => $companyId])
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            $employee,
            $this->testedClass->findByCompanyId($companyId)
        );
    }

    /**
     * @covers ::findByCompanyId
     */
    public function testFindByCompanyIdComplete()
    {
        $companyId = 10;
        $employee = factory(Employee::class, 10)->make([
            'id' => 1,
            'company_id' => $companyId,
        ]);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('find')
            ->with(['company_id' => $companyId])
            ->once()
            ->andReturn($employee);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('findById')
            ->times(10);

        $this->assertEquals(
            $employee,
            $this->testedClass->findByCompanyId($companyId, 'complete')
        );
    }

    /**
     * @covers ::remainingConsumptionLimit
     */
    public function testRemainingConsumptionLimit()
    {
        $employeeId = 10;
        $employee = factory(Employee::class)->make(['consumption_limit' => 101]);
        $employee = $this->pushFillUpsInEmployee($employee);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('findById')
            ->with($employeeId)
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            1.0,
            $this->testedClass->remainingConsumptionLimit($employeeId)
        );
    }

    /**
     * @covers ::remainingConsumptionLimit
     */
    public function testRemainingConsumptionLimitZero()
    {
        $employeeId = 10;
        $employee = factory(Employee::class)->make(['consumption_limit' => 100]);
        $employee = $this->pushFillUpsInEmployee($employee);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('findById')
            ->with($employeeId)
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            0,
            $this->testedClass->remainingConsumptionLimit($employeeId)
        );
    }

    /**
     * @covers ::remainingConsumptionLimit
     */
    public function testRemainingConsumptionLimitNegative()
    {
        $employeeId = 10;
        $employee = factory(Employee::class)->make(['consumption_limit' => 99]);
        $employee = $this->pushFillUpsInEmployee($employee);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('findById')
            ->with($employeeId)
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            -1.0,
            $this->testedClass->remainingConsumptionLimit($employeeId)
        );
    }

    /**
     * @covers ::remainingConsumptionLimit
     */
    public function testRemainingConsumptionLimitWithDates()
    {
        $employeeId = 10;
        $employee = factory(Employee::class)->make(['consumption_limit' => 100]);
        $employee = $this->pushFillUpsInEmployee($employee);

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('findById')
            ->with($employeeId)
            ->once()
            ->andReturn($employee);

        $this->assertEquals(
            -200.0,
            $this->testedClass->remainingConsumptionLimit(
                $employeeId,
                $this->dependencies[Carbon::class]->now()->subMonths(1)->toDateString(),
                $this->dependencies[Carbon::class]->now()->addMonths(1)->toDateString()
            )
        );
    }

    /**
     * @covers ::remainingConsumptionLimit
     */
    public function testRemainingConsumptionLimitEmptyEmployee()
    {
        $employeeId = 10;

        $this->dependencies[EmployeeRepository::class]
            ->shouldReceive('findById')
            ->with($employeeId)
            ->once();

        $this->assertEquals(
            0,
            $this->testedClass->remainingConsumptionLimit($employeeId)
        );
    }

}
