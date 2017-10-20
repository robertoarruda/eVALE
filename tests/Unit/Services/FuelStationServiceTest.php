<?php

namespace Tests\Nero\ValeExpress\Services;

use Mockery;
use Nero\ValeExpress\Models\FuelStation;
use Nero\ValeExpress\Repositories\FuelStationRepository;
use Nero\ValeExpress\Services\FuelStationService;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\ValeExpress\Services\FuelStationService
 */
class FuelStationServiceTest extends TestCase
{
    protected $testedClassName = FuelStationService::class;

    public function setUp()
    {
        $this->dependencies = [
            'fuelStationRepository' => Mockery::mock(FuelStationRepository::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new FuelStationService(...array_values($this->dependencies));

        $this->assertInstanceOf(FuelStationService::class, $testedClass);
    }

    /**
     * @covers ::index
     */
    public function testIndex()
    {
        $fuelStation = factory(FuelStation::class)->make();

        $this->dependencies['fuelStationRepository']
            ->shouldReceive('find')
            ->with([])
            ->once()
            ->andReturn($fuelStation);

        $this->assertEquals(
            ['list' => $fuelStation],
            $this->testedClass->index()
        );
    }

    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $fuelStation = factory(FuelStation::class)->make();

        $this->dependencies['fuelStationRepository']
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
     * @covers ::findById
     */
    public function testFindById()
    {
        $fuelStation = factory(FuelStation::class)->make(['id' => 1]);

        $this->dependencies['fuelStationRepository']
            ->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($fuelStation);

        $this->assertEquals(
            $fuelStation,
            $this->testedClass->findById(1)
        );
    }

    /**
     * @covers ::update
     */
    public function testUpdate()
    {
        $fuelStation = factory(FuelStation::class)->make(['id' => 1]);

        $this->dependencies['fuelStationRepository']
            ->shouldReceive('update')
            ->with(1, $fuelStation->toArray())
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
        $fuelStation = Mockery::mock(FuelStation::class);

        $this->dependencies['fuelStationRepository']
            ->shouldReceive('delete')
            ->with(1)
            ->once()
            ->andReturn($fuelStation);

        $this->assertEquals(
            $fuelStation,
            $this->testedClass->delete(1)
        );
    }
}
