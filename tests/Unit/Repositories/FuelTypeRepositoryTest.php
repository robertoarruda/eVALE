<?php

namespace Tests\Nero\Evale\Repositories;

use Mockery;
use Nero\Evale\Models\FuelType;
use Nero\Evale\Repositories\FuelTypeRepository;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Repositories\FuelTypeRepository
 */
class FuelTypeRepositoryTest extends TestCase
{
    protected $testedClassName = FuelTypeRepository::class;

    public function setUp()
    {
        $this->dependencies = [
            FuelType::class => Mockery::mock(FuelType::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new FuelTypeRepository(...array_values($this->dependencies));

        $this->assertInstanceOf(FuelTypeRepository::class, $testedClass);
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $fuelType = factory(FuelType::class, 1)->make();

        $this->dependencies[FuelType::class]
            ->shouldReceive('where->get')
            ->with(['id' => 1])
            ->with()
            ->once()
            ->andReturn($fuelType);

        $this->assertEquals(
            $fuelType,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $fuelType = factory(FuelType::class)->make();

        $this->dependencies[FuelType::class]
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($fuelType);

        $this->assertEquals(
            $fuelType,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $fuelType = factory(FuelType::class)->make();

        $this->dependencies[FuelType::class]
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
     * @covers ::update
     */
    public function testUpdate()
    {
        $fuelType = factory(FuelType::class)->make();

        $this->dependencies[FuelType::class]
            ->shouldReceive('where->first->fill->save')
            ->with('id', 1)
            ->with()
            ->with($fuelType->toArray())
            ->with()
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
        $this->dependencies[FuelType::class]
            ->shouldReceive('where->delete')
            ->with('id', 1)
            ->with()
            ->once()
            ->andReturn($this->dependencies[FuelType::class]);

        $this->assertInstanceOf(
            FuelType::class,
            $this->testedClass->delete(1)
        );
    }
}
