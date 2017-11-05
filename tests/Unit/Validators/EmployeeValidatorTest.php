<?php

namespace Tests\Nero\Evale\Validators;

use Illuminate\Validation\Validator;
use Mockery;
use Nero\Evale\Models\Employee;
use Nero\Evale\Services\CompanyService;
use Nero\Evale\Validators\EmployeeValidator;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Validators\EmployeeValidator
 */
class EmployeeValidatorTest extends TestCase
{
    protected $testedClassName = EmployeeValidator::class;

    public function setUp()
    {
        $this->otherDependencies = [
            Validator::class => Mockery::mock(Validator::class),
        ];

        $this->dependencies = [
            CompanyService::class => Mockery::mock(CompanyService::class),
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

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($parameters[0], [$parameters[1]])
            ->once()
            ->andReturn(50);

        $this->assertTrue(
            $this->testedClass
                ->validateSubscriptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateSubscriptionLimit
     */
    public function testValidateSubscriptionLimit2()
    {
        $attribute = '';
        $value = 40;
        $parameters = array_values(['companyId' => 10, 'employeeId' => 100]);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($parameters[0], [$parameters[1]])
            ->once()
            ->andReturn(50);

        $this->assertTrue(
            $this->testedClass
                ->validateSubscriptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateSubscriptionLimit
     */
    public function testValidateSubscriptionLimitInvalid()
    {
        $attribute = '';
        $value = 60;
        $parameters = array_values(['companyId' => 10, 'employeeId' => 100]);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($parameters[0], [$parameters[1]])
            ->once()
            ->andReturn(50);

        $this->assertFalse(
            $this->testedClass
                ->validateSubscriptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateSubscriptionLimit
     */
    public function testValidateSubscriptionLimitEmpty()
    {
        $attribute = '';
        $value = 50;
        $parameters = array_values(['companyId' => 10, 'employeeId' => 100]);

        $this->dependencies[CompanyService::class]
            ->shouldReceive('remainingSubscription')
            ->with($parameters[0], [$parameters[1]])
            ->once();

        $this->assertFalse(
            $this->testedClass
                ->validateSubscriptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }
}
