<?php

namespace Tests\Nero\Evale\Validators;

use Hash;
use Illuminate\Validation\Validator;
use Mockery;
use Nero\Evale\Models\Employee;
use Nero\Evale\Services\EmployeeService;
use Nero\Evale\Validators\FillUpValidator;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Validators\FillUpValidator
 */
class FillUpValidatorTest extends TestCase
{
    protected $testedClassName = FillUpValidator::class;

    public function setUp()
    {
        $this->otherDependencies = [
            Validator::class => Mockery::mock(Validator::class),
        ];

        $this->dependencies = [
            EmployeeService::class => Mockery::mock(EmployeeService::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new FillUpValidator(...array_values($this->dependencies));

        $this->assertInstanceOf(FillUpValidator::class, $testedClass);
    }

    /**
     * @covers ::validateEmployeeLogin
     */
    public function testValidateEmployeeLogin()
    {
        $attribute = '';
        $value = '0001234';
        $parameters = array_values(['companyId' => 10, 'password' => 123456]);

        $employee = factory(Employee::class, 1)->make(['password' => $parameters[1]]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with([
                'company_id' => $parameters[0],
                'registration_number' => $value,
            ])
            ->once()
            ->andReturn($employee);

        Hash::shouldReceive('check')
            ->with($parameters[1], $employee->first()->password)
            ->once()
            ->andReturn(true);

        $this->assertTrue(
            $this->testedClass
                ->validateEmployeeLogin(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateEmployeeLogin
     */
    public function testValidateEmployeeLoginDifferents()
    {
        $attribute = '';
        $value = '0001234';
        $parameters = array_values(['companyId' => 10, 'password' => 123456]);

        $employee = factory(Employee::class, 1)->make(['password' => 012345]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with([
                'company_id' => $parameters[0],
                'registration_number' => $value,
            ])
            ->once()
            ->andReturn($employee);

        Hash::shouldReceive('check')
            ->with($parameters[1], $employee->first()->password)
            ->once()
            ->andReturn(false);

        $this->assertFalse(
            $this->testedClass
                ->validateEmployeeLogin(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateEmployeeLogin
     */
    public function testValidateEmployeeLoginEmptyPassword()
    {
        $attribute = '';
        $value = '0001234';
        $parameters = array_values(['companyId' => 10, 'password' => 123456]);

        $employee = factory(Employee::class, 0)->make();
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with([
                'company_id' => $parameters[0],
                'registration_number' => $value,
            ])
            ->once()
            ->andReturn($employee);

        $this->assertFalse(
            $this->testedClass
                ->validateEmployeeLogin(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateConsumptionLimit
     */
    public function testValidateConsumptionLimit()
    {
        $attribute = '';
        $value = 10;
        $parameters = array_values(['registration_number' => '0001234']);

        $this->otherDependencies[Validator::class]
            ->shouldReceive('failed')
            ->with()
            ->once();

        $employee = factory(Employee::class, 1)->make(['id' => 1]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with(['registration_number' => $parameters[0]])
            ->once()
            ->andReturn($employee);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('remainingConsumptionLimit')
            ->with($employee->first()->id)
            ->once()
            ->andReturn(20);

        $this->assertTrue(
            $this->testedClass
                ->validateConsumptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateConsumptionLimit
     */
    public function testValidateConsumptionLimitZero()
    {
        $attribute = '';
        $value = 10;
        $parameters = array_values(['registration_number' => '0001234']);

        $this->otherDependencies[Validator::class]
            ->shouldReceive('failed')
            ->with()
            ->once();

        $employee = factory(Employee::class, 1)->make(['id' => 1]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with(['registration_number' => $parameters[0]])
            ->once()
            ->andReturn($employee);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('remainingConsumptionLimit')
            ->with($employee->first()->id)
            ->once()
            ->andReturn(10);

        $this->assertTrue(
            $this->testedClass
                ->validateConsumptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateConsumptionLimit
     */
    public function testValidateConsumptionLimitInvalid()
    {
        $attribute = '';
        $value = 10;
        $parameters = array_values(['registration_number' => '0001234']);

        $this->otherDependencies[Validator::class]
            ->shouldReceive('failed')
            ->with()
            ->once();

        $employee = factory(Employee::class, 1)->make(['id' => 1]);
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with(['registration_number' => $parameters[0]])
            ->once()
            ->andReturn($employee);

        $this->dependencies[EmployeeService::class]
            ->shouldReceive('remainingConsumptionLimit')
            ->with($employee->first()->id)
            ->once()
            ->andReturn(5);

        $this->assertFalse(
            $this->testedClass
                ->validateConsumptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }
    /**
     * @covers ::validateConsumptionLimit
     */
    public function testValidateConsumptionLimitEmptyEmployeeId()
    {
        $attribute = '';
        $value = 10;
        $parameters = array_values(['registration_number' => '0001234']);

        $this->otherDependencies[Validator::class]
            ->shouldReceive('failed')
            ->with()
            ->once();

        $employee = factory(Employee::class, 0)->make();
        $this->dependencies[EmployeeService::class]
            ->shouldReceive('find')
            ->with(['registration_number' => $parameters[0]])
            ->once()
            ->andReturn($employee);

        $this->assertFalse(
            $this->testedClass
                ->validateConsumptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

    /**
     * @covers ::validateConsumptionLimit
     */
    public function testValidateConsumptionLimitHasEmployeeRegistrationNumber()
    {
        $attribute = '';
        $value = 10;
        $parameters = array_values(['registration_number' => '0001234']);

        $this->otherDependencies[Validator::class]
            ->shouldReceive('failed')
            ->with()
            ->once()
            ->andReturn(['employee_registration_number' => 1]);

        $this->assertTrue(
            $this->testedClass
                ->validateConsumptionLimit(
                    $attribute,
                    $value,
                    $parameters,
                    $this->otherDependencies[Validator::class]
                )
        );
    }

}
