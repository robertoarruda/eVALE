<?php

namespace Tests\Nero\Evale\Http\Requests;

use Illuminate\Http\Request;
use Mockery;
use Nero\Evale\Http\Requests\EmployeeFormRequest;
use Nero\Evale\Models\Company;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Http\Requests\EmployeeFormRequest
 */
class EmployeeFormRequestTest extends TestCase
{
    protected $testedClassName = EmployeeFormRequest::class;

    public function setUp()
    {
        $this->otherDependencies = [
            Request::class => Mockery::mock(Request::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::authorize
     */
    public function testAuthorize()
    {
        $this->assertTrue($this->testedClass->authorize());
    }

    /**
     * @covers ::rules
     */
    public function testRules()
    {
        $this->otherDependencies[Request::class]->employeeId = 100;
        $this->otherDependencies[Request::class]->password = '';

        $company = factory(Company::class)->make(['id' => 10]);
        $this->otherDependencies[Request::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            [
                'name' => 'required',
                'cpf' => "required|unique:employees,cpf,100",
                'registration_number' => "required|unique:employees,registration_number,100",
                'consumption_limit' => "required|subscription_limit:10,100",
            ],
            $this->testedClass->rules($this->otherDependencies[Request::class])
        );
    }

    /**
     * @covers ::rules
     */
    public function testRulesHasPassword()
    {
        $this->otherDependencies[Request::class]->employeeId = 100;
        $this->otherDependencies[Request::class]->password = 123456;

        $company = factory(Company::class)->make(['id' => 10]);
        $this->otherDependencies[Request::class]
            ->shouldReceive('user')
            ->with()
            ->once()
            ->andReturn($company);

        $this->assertEquals(
            [
                'name' => 'required',
                'cpf' => "required|unique:employees,cpf,100",
                'registration_number' => "required|unique:employees,registration_number,100",
                'consumption_limit' => "required|subscription_limit:10,100",
                'password' => 'confirmed',
            ],
            $this->testedClass->rules($this->otherDependencies[Request::class])
        );
    }

    /**
     * @covers ::messages
     */
    public function testMessages()
    {
        $this->assertEquals(
            [
                'cpf.unique' => 'CPF informado já existe.',
                'registration_number.unique' => 'Número de matricula informado já existe.',
                'password.confirmed' => 'Confirmação da senha não confere.',
            ],
            $this->testedClass->messages()
        );
    }
}
