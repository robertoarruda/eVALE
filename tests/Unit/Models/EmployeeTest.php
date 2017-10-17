<?php

namespace Tests\Nero\ValeExpress\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\ValeExpress\Models\Company;
use Nero\ValeExpress\Models\Employee;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\ValeExpress\Models\Employee
 */
class EmployeeTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = Employee::class;

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
                'company_id',
                'registration_number',
                'name',
                'balance',
            ],
            $property->getValue($this->testedClass)
        );
    }

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
}
