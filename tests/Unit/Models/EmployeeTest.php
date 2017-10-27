<?php

namespace Tests\Nero\Evale\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\Employee;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Models\Employee
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
                'name',
                'cpf',
                'registration_number',
                'consumption_limit',
                'password',
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
        $employee = factory(Employee::class, 'create')
            ->create(['company_id' => $company->id]);

        $this->assertEquals(
            $company->toArray(),
            $employee->company->toArray()
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
