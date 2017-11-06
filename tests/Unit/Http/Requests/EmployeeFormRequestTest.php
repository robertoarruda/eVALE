<?php

namespace Tests\Nero\Evale\Http\Requests;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Mockery;
use Nero\Evale\Http\Requests\EmployeeFormRequest;
use Nero\Evale\Models\Company;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Http\Requests\EmployeeFormRequest
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class EmployeeFormRequestTest extends TestCase
{
    protected $testedClassName = EmployeeFormRequest::class;

    public function setUp()
    {
        $this->otherDependencies = [
            Request::class => Mockery::mock(Request::class),
            Rule::class => Mockery::mock('alias:' . Rule::class),
            Builder::class => Mockery::mock(Builder::class),
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

        $this->otherDependencies[Rule::class]
            ->shouldReceive('unique')
            ->with('employees')
            ->once()
            ->andReturnSelf()
            ->shouldReceive('ignore')
            ->with($this->otherDependencies[Request::class]->employeeId)
            ->once()
            ->andReturnSelf()
            ->shouldReceive('where')
            ->with(Mockery::on(function ($query) use ($company) {
                $this->otherDependencies[Builder::class]
                    ->shouldReceive('where')
                    ->with('company_id', $company->id)
                    ->once()
                    ->andReturn(true);

                return $query($this->otherDependencies[Builder::class]);
            }))
            ->once()
            ->andReturn(true);

        $this->assertEquals(
            [
                'name' => 'required',
                'cpf' => "required|unique:employees,cpf,100",
                'registration_number' => ['required', true],
                'consumption_limit' => "required|subscription_limit:10,100",
            ],
            $this->testedClass->rules(
                $this->otherDependencies[Request::class],
                $this->otherDependencies[Rule::class]
            )
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

        $this->otherDependencies[Rule::class]
            ->shouldReceive('unique')
            ->with('employees')
            ->once()
            ->andReturnSelf()
            ->shouldReceive('ignore')
            ->with($this->otherDependencies[Request::class]->employeeId)
            ->once()
            ->andReturnSelf()
            ->shouldReceive('where')
            ->with(Mockery::on(function ($query) use ($company) {
                $this->otherDependencies[Builder::class]
                    ->shouldReceive('where')
                    ->with('company_id', $company->id)
                    ->once()
                    ->andReturn(true);

                return $query($this->otherDependencies[Builder::class]);
            }))
            ->once()
            ->andReturn(true);

        $this->assertEquals(
            [
                'name' => 'required',
                'cpf' => "required|unique:employees,cpf,100",
                'registration_number' => ['required', true],
                'consumption_limit' => "required|subscription_limit:10,100",
                'password' => 'confirmed',
            ],
            $this->testedClass->rules(
                $this->otherDependencies[Request::class],
                $this->otherDependencies[Rule::class]
            )
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
                'consumption_limit.subscription_limit' => 'Limite de consumo informado supera o limite da assinatura.',
            ],
            $this->testedClass->messages()
        );
    }
}
