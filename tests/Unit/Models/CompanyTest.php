<?php

namespace Tests\Nero\Evale\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\Employee;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Models\Company
 */
class CompanyTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = Company::class;

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
                'subscription_limit',
                'login',
                'password',
            ],
            $property->getValue($this->testedClass)
        );
    }

    /**
     * @covers ::employees
     */
    public function testRelationWithEmployee()
    {
        $company = factory(Company::class)->create();
        $employees = factory(Employee::class, 5)
            ->create(['company_id' => $company->id]);

        $this->assertEquals(
            $employees->toArray(),
            $company->employees->toArray()
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