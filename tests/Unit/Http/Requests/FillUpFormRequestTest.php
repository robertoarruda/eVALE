<?php

namespace Tests\Nero\Evale\Http\Requests;

use Illuminate\Http\Request;
use Mockery;
use Nero\Evale\Http\Requests\FillUpFormRequest;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Http\Requests\FillUpFormRequest
 */
class FillUpFormRequestTest extends TestCase
{
    protected $testedClassName = FillUpFormRequest::class;

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
        $this->otherDependencies[Request::class]->company_id = 10;
        $this->otherDependencies[Request::class]->employee_registration_number = 'abcdef';
        $this->otherDependencies[Request::class]->employee_password = 123456;

        $this->assertEquals(
            [
                'company_id' => 'required',
                'fuel_type_id' => 'required',
                'employee_registration_number' => "required|employee_login:10,123456",
                'employee_password' => 'required',
                'value' => "required|consumption_limit:abcdef",
            ],
            $this->testedClass->rules($this->otherDependencies[Request::class])
        );
    }

    /**
    /**
     * @covers ::messages
     */
    public function testMessages()
    {
        $this->assertEquals(
            [
                'employee_registration_number.employee_login' => 'Senha inválida ou número de matrícula inexistente nesta empresa.',
                'value.consumption_limit' => 'Valor informado supera o limite de consumo do funcionário.',
            ],
            $this->testedClass->messages()
        );
    }
}
