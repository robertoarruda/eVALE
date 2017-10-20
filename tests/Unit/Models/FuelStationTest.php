<?php

namespace Tests\Nero\ValeExpress\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\ValeExpress\Models\FuelStation;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\ValeExpress\Models\FuelStation
 */
class FuelStationTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = FuelStation::class;

    protected $activeReflection = true;

    /**
     * @coversNothing
     */
    public function testFillable()
    {
        $property = $this->reflection->getProperty('fillable');
        $property->setAccessible(true);

        $this->assertEquals(
            [
                'name',
                'cnpj',
                'address',
                'phone',
            ],
            $property->getValue($this->testedClass)
        );
    }
}
