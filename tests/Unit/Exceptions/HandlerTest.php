<?php

namespace Tests\Nero\Evale\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery;
use Nero\Evale\Exceptions\Handler;
use Tests\TestCase;
use URL;

/**
 * @coversDefaultClass \Nero\Evale\Exceptions\Handler
 */
class HandlerTest extends TestCase
{
    protected $testedClassName = Handler::class;

    protected $activeReflection = true;

    public function setUp()
    {
        $this->otherDependencies = [
            'request' => Mockery::mock(Request::class),
            'response' => Mockery::mock(Response::class),
            'authenticationException' => Mockery::mock(AuthenticationException::class),
        ];

        $this->dependencies = [
            'container' => Mockery::mock(Container::class),
        ];

        parent::setUp();
    }

    /**
     * @covers ::unauthenticated
     */
    public function testUnauthenticatedCompany()
    {
        $method = $this->reflection->getMethod('unauthenticated');
        $method->setAccessible(true);

        $this->otherDependencies['request']
            ->shouldReceive('route')
            ->with()
            ->once()
            ->andReturn()
            ->shouldReceive('expectsJson')
            ->with()
            ->once()
            ->andReturn(false);

        URL::shouldReceive('route')
            ->with('company.login', [], true)
            ->once()
            ->andReturn('company')
            ->shouldReceive('full')
            ->with()
            ->once()
            ->andReturn('company')
            ->shouldReceive('to')
            ->with('company', [], null)
            ->once()
            ->andReturn('company')
            ->shouldReceive('getRequest')
            ->with()
            ->once()
            ->andReturn($this->otherDependencies['request']);

        $method->invoke(
            $this->testedClass,
            $this->otherDependencies['request'],
            $this->otherDependencies['authenticationException']
        );
    }

    /**
     * @covers ::unauthenticated
     */
    public function testUnauthenticatedExpectsJson()
    {
        $method = $this->reflection->getMethod('unauthenticated');
        $method->setAccessible(true);

        $this->otherDependencies['request']
            ->shouldReceive('route')
            ->with()
            ->once()
            ->andReturn((object) ['action' => ['as' => null]])
            ->shouldReceive('expectsJson')
            ->with()
            ->once()
            ->andReturn(true);

        URL::shouldReceive('route')
            ->with('admin.login', [], true)
            ->never();

        $method->invoke(
            $this->testedClass,
            $this->otherDependencies['request'],
            $this->otherDependencies['authenticationException']
        );
    }

    /**
     * @covers ::unauthenticated
     */
    public function testUnauthenticatedAdmin()
    {
        $method = $this->reflection->getMethod('unauthenticated');
        $method->setAccessible(true);

        $this->otherDependencies['request']
            ->shouldReceive('route')
            ->with()
            ->once()
            ->andReturn((object) ['action' => ['as' => 'admin.index']])
            ->shouldReceive('expectsJson')
            ->with()
            ->once()
            ->andReturn(false);

        URL::shouldReceive('route')
            ->with('admin.login', [], true)
            ->once()
            ->andReturn('admin')
            ->shouldReceive('full')
            ->with()
            ->once()
            ->andReturn('admin')
            ->shouldReceive('to')
            ->with('admin', [], null)
            ->once()
            ->andReturn('admin')
            ->shouldReceive('getRequest')
            ->with()
            ->once()
            ->andReturn($this->otherDependencies['request']);

        $method->invoke(
            $this->testedClass,
            $this->otherDependencies['request'],
            $this->otherDependencies['authenticationException']
        );
    }
}
