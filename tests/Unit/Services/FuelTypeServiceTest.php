<?php

namespace Tests\Nero\Evale\Services;

use Mockery;
use Nero\Evale\Models\FuelType;
use Nero\Evale\Repositories\FuelTypeRepository;
use Nero\Evale\Services\FuelTypeService;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Services\FuelTypeService
 */
class FuelTypeServiceTest extends TestCase
{
    protected $testedClassName = FuelTypeService::class;

    public function setUp()
    {
        $this->dependencies = [
            FuelTypeRepository::class => Mockery::mock(FuelTypeRepository::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new FuelTypeService(...array_values($this->dependencies));

        $this->assertInstanceOf(FuelTypeService::class, $testedClass);
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $fuelType = factory(FuelType::class)->make();

        $this->dependencies[FuelTypeRepository::class]
            ->shouldReceive('create')
            ->with($fuelType->toArray())
            ->once()
            ->andReturn($fuelType);

        $this->assertEquals(
            $fuelType,
            $this->testedClass->create($fuelType->toArray())
        );
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $fuelTypes = factory(FuelType::class, 1)->make(['id' => 1]);

        $this->dependencies[FuelTypeRepository::class]
            ->shouldReceive('find')
            ->with(['id' => 1])
            ->once()
            ->andReturn($fuelTypes);

        $this->assertEquals(
            $fuelTypes,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $fuelType = factory(FuelType::class)->make(['id' => 1]);

        $this->dependencies[FuelTypeRepository::class]
            ->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($fuelType);

        $this->assertEquals(
            $fuelType,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $fuelType = factory(FuelType::class)->make(['id' => 1]);

        $this->dependencies[FuelTypeRepository::class]
            ->shouldReceive('update')
            ->with(1, $fuelType->toArray())
            ->once()
            ->andReturn($fuelType);

        $this->assertEquals(
            $fuelType,
            $this->testedClass->update(1, $fuelType->toArray())
        );
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $fuelType = Mockery::mock(FuelType::class);

        $this->dependencies[FuelTypeRepository::class]
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn($fuelType);

        $this->assertEquals(
            $fuelType,
            $this->testedClass->delete(1)
        );
    }
}
