<?php

namespace Tests\Nero\Evale\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\Employee;
use Nero\Evale\Models\FillUp;
use Nero\Evale\Models\FuelType;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Models\FillUp
 */
class FillUpTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = FillUp::class;

    /**
     * @covers ::company
     */
    public function testRelationWithCompany()
    {
        $company = factory(Company::class)->create();
        $fillUp = factory(FillUp::class)
            ->create(['company_id' => $company->id]);

        $this->assertEquals(
            $company->toArray(),
            $fillUp->company->toArray()
        );
    }

    /**
     * @covers ::employee
     */
    public function testRelationWithEmployee()
    {
        $employee = factory(Employee::class)->create();
        $fillUp = factory(FillUp::class)
            ->create(['employee_id' => $employee->id]);

        $this->assertEquals(
            $employee->toArray(),
            $fillUp->employee->toArray()
        );
    }

    /**
     * @covers ::fuelType
     */
    public function testRelationWithFuelType()
    {
        $fuelType = factory(FuelType::class)->create();
        $fillUp = factory(FillUp::class)
            ->create(['fuel_type_id' => $fuelType->id]);

        $this->assertEquals(
            $fuelType->toArray(),
            $fillUp->fuelType->toArray()
        );
    }
}
