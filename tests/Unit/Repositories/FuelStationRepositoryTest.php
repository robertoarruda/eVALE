<?php

namespace Tests\Nero\ValeExpress\Repositories;

use Mockery;
use Nero\ValeExpress\Models\FuelStation;
use Nero\ValeExpress\Repositories\FuelStationRepository;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\ValeExpress\Repositories\FuelStationRepository
 */
class FuelStationRepositoryTest extends TestCase
{
    protected $testedClassName = FuelStationRepository::class;

    public function setUp()
    {
        $this->dependencies = [
            'fuelStation' => Mockery::mock(FuelStation::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new FuelStationRepository(...array_values($this->dependencies));

        $this->assertInstanceOf(FuelStationRepository::class, $testedClass);
    }

    /**
     * @covers ::find
     */
    public function testFind()
    {
        $fuelStation = factory(FuelStation::class, 1)->make();

        $this->dependencies['fuelStation']
            ->shouldReceive('where->get')
            ->with(['id' => 1])
            ->with()
            ->once()
            ->andReturn($fuelStation);

        $this->assertEquals(
            $fuelStation,
            $this->testedClass->find(['id' => 1])
        );
    }

    /**
     * @covers ::findById
     */
    public function testFindById()
    {
        $fuelStation = factory(FuelStation::class)->make();

        $this->dependencies['fuelStation']
            ->shouldReceive('find')
            ->with(1)
            ->once()
            ->andReturn($fuelStation);

        $this->assertEquals(
            $fuelStation,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $fuelStation = factory(FuelStation::class)->make();

        $this->dependencies['fuelStation']
            ->shouldReceive('create')
            ->with($fuelStation->toArray())
            ->once()
            ->andReturn($fuelStation);

        $this->assertEquals(
            $fuelStation,
            $this->testedClass->create($fuelStation->toArray())
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $fuelStation = factory(FuelStation::class)->make();

        $this->dependencies['fuelStation']
            ->shouldReceive('where->update')
            ->with('id', 1)
            ->with($fuelStation->toArray())
            ->once()
            ->andReturn($fuelStation);

        $this->assertEquals(
            $fuelStation,
            $this->testedClass->update(1, $fuelStation->toArray())
        );
    }

    /**
     * @covers ::delete
     */
    public function testDelete()
    {
        $this->dependencies['fuelStation']
            ->shouldReceive('where->delete')
            ->with('id', 1)
            ->with()
            ->once()
            ->andReturn($this->dependencies['fuelStation']);

        $this->assertInstanceOf(
            FuelStation::class,
            $this->testedClass->delete(1)
        );
    }
}
