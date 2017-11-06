<?php

namespace Tests\Nero\Evale\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\Evale\Models\FillUp;
use Nero\Evale\Models\FuelType;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Models\FuelType
 */
class FuelTypeTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = FuelType::class;

    /**
     * @covers ::fillUps
     */
    public function testRelationWithFillUps()
    {
        $fuelType = factory(FuelType::class)->create();
        $fillUps = factory(FillUp::class, 5)
            ->create(['fuel_type_id' => $fuelType->id]);

        $this->assertEquals(
            $fillUps->toArray(),
            $fuelType->fillUps->toArray()
        );
    }
}
