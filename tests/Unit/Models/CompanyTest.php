<?php

namespace Tests\Nero\Evale\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Nero\Evale\Models\Company;
use Nero\Evale\Models\Employee;
use Nero\Evale\Models\FillUp;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Models\Company
 */
class CompanyTest extends TestCase
{
    use DatabaseMigrations;

    protected $testedClassName = Company::class;

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
     * @covers ::fillUps
     */
    public function testRelationWithFillUp()
    {
        $company = factory(Company::class)->create();
        $fillUps = factory(FillUp::class, 5)
            ->create(['company_id' => $company->id]);

        $this->assertEquals(
            $fillUps->toArray(),
            $company->fillUps->toArray()
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
