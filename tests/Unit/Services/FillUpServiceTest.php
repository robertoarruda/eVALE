<?php

namespace Tests\Nero\Evale\Services;

use Carbon\Carbon;
use Mockery;
use Nero\Evale\Models\FillUp;
use Nero\Evale\Repositories\FillUpRepository;
use Nero\Evale\Services\EmployeeService;
use Nero\Evale\Services\FillUpService;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Services\FillUpService
 */
class FillUpServiceTest extends TestCase
{
    protected $testedClassName = FillUpService::class;

    public function setUp()
    {
        $this->dependencies = [
            FillUpRepository::class => Mockery::mock(FillUpRepository::class),
            EmployeeService::class => Mockery::mock(EmployeeService::class),
            Carbon::class => new Carbon(),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $fillUp = factory(FillUp::class)->make(['id' => 1]);
        $testedClass = new FillUpService(...array_values($this->dependencies));

        $this->assertInstanceOf(FillUpService::class, $testedClass);
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $fillUp = factory(FillUp::class)->make();

        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('create')
            ->with($fillUp->toArray())
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->create($fillUp->toArray())
        );
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $fillUps = factory(FillUp::class, 1)->make(['id' => 1]);

        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1])
            ->once()
            ->andReturn($fillUps);

        $this->assertEquals(
            $fillUps,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $fillUp = factory(FillUp::class)->make(['id' => 1]);

        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $fillUp = factory(FillUp::class)->make(['id' => 1]);

        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('update')
            ->with(1, $fillUp->toArray())
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->update(1, $fillUp->toArray())
        );
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $fillUp = Mockery::mock(FillUp::class);

        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->delete(1)
        );
    }

    /**
     * @covers ::filter
     */
    public function testFilter()
    {
        $companyId = 10;

        $params = [
            ['created_at', '>=', $this->testedClass->dateOrStartOfMonth()],
            ['created_at', '<=', $this->testedClass->dateOrEndOfMonth()],
            'company_id' => $companyId,
        ];

        $fillUps = factory(FillUp::class, 10)->make();
        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('find')
            ->with($params)
            ->once()
            ->andReturn($fillUps);

        $this->assertEquals(
            $fillUps,
            $this->testedClass->filter($companyId)
        );
    }

    /**
     * @covers ::filter
     */
    public function testFilterWithEmployee()
    {
        $companyId = 10;
        $employeeId = 100;

        $params = [
            ['created_at', '>=', $this->testedClass->dateOrStartOfMonth()],
            ['created_at', '<=', $this->testedClass->dateOrEndOfMonth()],
            'company_id' => $companyId,
            'employee_id' => $employeeId,
        ];

        $fillUps = factory(FillUp::class, 10)->make();
        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('find')
            ->with($params)
            ->once()
            ->andReturn($fillUps);

        $this->assertEquals(
            $fillUps,
            $this->testedClass->filter($companyId, $employeeId)
        );
    }

    /**
     * @covers ::filter
     */
    public function testFilterWithEmployeeAndDates()
    {
        $companyId = 10;
        $employeeId = 100;
        $initialDate = '1985-07-10';
        $finalDate = '1989-03-07';

        $params = [
            ['created_at', '>=', $this->testedClass->dateOrStartOfMonth($initialDate)],
            ['created_at', '<=', $this->testedClass->dateOrEndOfMonth($finalDate)],
            'company_id' => $companyId,
            'employee_id' => $employeeId,
        ];

        $fillUps = factory(FillUp::class, 10)->make();
        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('find')
            ->with($params)
            ->once()
            ->andReturn($fillUps);

        $this->assertEquals(
            $fillUps,
            $this->testedClass->filter($companyId, $employeeId, $initialDate, $finalDate)
        );
    }

    /**
     * @covers ::post
     */
    public function testPost()
    {
        $params = [
            'company_id' => 10,
            'employee_registration_number' => 'abcdef',
            'employee_id' => 100,
        ];

        $employees = factory(FillUp::class, 1)->make(['id' => $params['employee_id']]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with([
                'company_id' => $params['company_id'],
                'registration_number' => $params['employee_registration_number'],
            ])
            ->once()
            ->andReturn($employees);

        $fillUp = factory(FillUp::class)->make($params);
        $this->dependencies[FillUpRepository::class]
            ->shouldReceive('create')
            ->with($params)
            ->once()
            ->andReturn($fillUp);

        $this->assertEquals(
            $fillUp,
            $this->testedClass->post($params)
        );
    }

}
