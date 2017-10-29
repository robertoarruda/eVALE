<?php

namespace Tests\Nero\Evale\Http\Requests;

use Illuminate\Http\Request;
use Mockery;
use Nero\Evale\Http\Requests\CompanyFormRequest;
use Tests\TestCase;

/**
 * @coversDefaultClass \Nero\Evale\Http\Requests\CompanyFormRequest
 */
class CompanyFormRequestTest extends TestCase
{
    protected $testedClassName = CompanyFormRequest::class;

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
        $this->otherDependencies[Request::class]->companyId = 10;
        $this->otherDependencies[Request::class]->password = '';

        $this->assertEquals(
            [
                'name' => 'required',
                'cnpj' => "required|unique:companies,cnpj,10",
                'address' => 'nullable',
                'phone' => 'nullable',
                'subscription_limit' => 'required',
                'login' => "required|unique:companies,login,10",
            ],
            $this->testedClass->rules($this->otherDependencies[Request::class])
        );
    }

    /**
     * @covers ::rules
     */
    public function testRulesHasPassword()
    {
        $this->otherDependencies[Request::class]->companyId = 10;
        $this->otherDependencies[Request::class]->password = 123456;

        $this->assertEquals(
            [
                'name' => 'required',
                'cnpj' => "required|unique:companies,cnpj,10",
                'address' => 'nullable',
                'phone' => 'nullable',
                'subscription_limit' => 'required',
                'login' => "required|unique:companies,login,10",
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
                'cnpj.unique' => 'CNPJ informado já existe.',
                'login.unique' => 'Login informado já existe.',
                'password.confirmed' => 'Confirmação da senha não confere.',
            ],
            $this->testedClass->messages()
        );
    }
}
