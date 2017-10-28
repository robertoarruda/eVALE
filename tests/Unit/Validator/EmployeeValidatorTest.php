<?php

namespace Tests\Nero\Evale\Services;

use Mockery;
use Nero\Evale\Models\Employee;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Services\EmployeeService;
use Nero\Evale\Validator\EmployeeValidator;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Validator\EmployeeValidator
 */
class EmployeeValidatorTest extends TestCase
{
    protected $testedClassName = EmployeeValidator::class;

    public function setUp()
    {
        $this->dependencies = [
            CompanyService::class => Mockery::mock(CompanyService::class),
            EmployeeService::class => Mockery::mock(EmployeeService::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new EmployeeValidator(...array_values($this->dependencies));

        $this->assertInstanceOf(EmployeeValidator::class, $testedClass);
    }

    /**
     * @covers ::validateSubscriptionLimit
     */
    public function testValidateSubscriptionLimit()
    {
        $attribute = '';
        $value = 50;
        $parameters = array_values(['companyId' => 10, 'employeeId' => 100]);
        $validator = '';

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($parameters[0])
            ->once()
            ->andReturn(50);

        $employee = factory(Employee::class)->make(['consumption_limit' => 10]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('findById')
            ->with($parameters[1])
            ->once()
            ->andReturn($employee);

        $this->assertTrue(
            $this->testedClass
                ->validateSubscriptionLimit($attribute, $value, $parameters, $validator)
        );
    }

    /**
     * @covers ::validateSubscriptionLimit
     */
    public function testValidateSubscriptionLimit2()
    {
        $attribute = '';
        $value = 60;
        $parameters = array_values(['companyId' => 10, 'employeeId' => 100]);
        $validator = '';

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($parameters[0])
            ->once()
            ->andReturn(50);

        $employee = factory(Employee::class)->make(['consumption_limit' => 10]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('findById')
            ->with($parameters[1])
            ->once()
            ->andReturn($employee);

        $this->assertTrue(
            $this->testedClass
                ->validateSubscriptionLimit($attribute, $value, $parameters, $validator)
        );
    }

    /**
     * @covers ::validateSubscriptionLimit
     */
    public function testValidateSubscriptionLimitInvalid()
    {
        $attribute = '';
        $value = 70;
        $parameters = array_values(['companyId' => 10, 'employeeId' => 100]);
        $validator = '';

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($parameters[0])
            ->once()
            ->andReturn(50);

        $employee = factory(Employee::class)->make(['consumption_limit' => 10]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('findById')
            ->with($parameters[1])
            ->once()
            ->andReturn($employee);

        $this->assertFalse(
            $this->testedClass
                ->validateSubscriptionLimit($attribute, $value, $parameters, $validator)
        );
    }
}
