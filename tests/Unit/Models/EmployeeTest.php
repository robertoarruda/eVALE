<?php

namespace Tests\Nero\Evale\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\Employee;
use Nero\Evale\Models\FillUp;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Models\Employee
 */
class EmployeeTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = Employee::class;

    /**
     * @covers ::company
     */
    public function testRelationWithCompany()
    {
        $company = factory(Company::class)->create();
        $employee = factory(Employee::class)
            ->create(['company_id' => $company->id]);

        $this->assertEquals(
            $company->toArray(),
            $employee->company->toArray()
        );
    }

    /**
     * @covers ::fillUps
     */
    public function testRelationWithFillUp()
    {
        $employee = factory(Employee::class)->create();
        $fillUps = factory(FillUp::class, 5)
            ->create(['employee_id' => $employee->id]);

        $this->assertEquals(
            $fillUps->toArray(),
            $employee->fillUps->toArray()
        );
    }

    /**
     * @covers ::setPasswordAttribute
     */
    public function testSetPasswordAttribute()
    {
        $hash = $this->testedClass->setPasswordAttribute('password');

        $this->assertAttributeEquals(
            ['password' => $hash],
            'attributes',
            $this->testedClass
        );
    }
}
