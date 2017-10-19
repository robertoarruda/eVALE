<?php

namespace Tests\Nero\ValeExpress\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\ValeExpress\Models\Company;
use Nero\ValeExpress\Models\Employee;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\ValeExpress\Models\Company
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
}
