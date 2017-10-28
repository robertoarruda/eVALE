<?php

namespace Tests\Nero\Evale\Http\Controllers;

use Illuminate\Auth\SessionGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Nero\Evale\Http\Controllers\CompanyLoginController;
use Tests\TestCase;
use View;

/**
 * @coversDefaultClass \Nero\Evale\Http\Controllers\CompanyLoginController
 */
class CompanyLoginControllerTest extends TestCase
{
    protected $testedClassName = CompanyLoginController::class;

    protected $activeReflection = true;

    public function setUp()
    {
        $this->otherDependencies = [
            Request::class => Mockery::mock(Request::class),
            SessionGuard::class => Mockery::mock(SessionGuard::class),
            Response::class => Mockery::mock(Response::class),
        ];

        $this->dependencies = [
            Auth::class => new Auth(),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new CompanyLoginController(...array_values($this->dependencies));

        $this->assertInstanceOf(CompanyLoginController::class, $testedClass);
    }

    /**
     * @covers ::showLoginForm
     */
    public function testShowLoginForm()
    {
        $this->dependencies[Auth::class]
            ->shouldReceive('guard')
            ->with('company')
            ->once()
            ->andReturn($this->otherDependencies[SessionGuard::class]);

        $this->otherDependencies[SessionGuard::class]
            ->shouldReceive('check')
            ->with()
            ->once()
            ->andReturn(false);

        $this->dependencies[Auth::class]
            ->shouldReceive('guard')
            ->with('admin')
            ->once()
            ->andReturn($this->otherDependencies[SessionGuard::class]);

        $this->otherDependencies[SessionGuard::class]
            ->shouldReceive('check')
            ->with()
            ->once()
            ->andReturn(false);

        View::shouldReceive('make')
            ->with('company.auth.login', [], [])
            ->once()
            ->andReturn($this->otherDependencies[Response::class]);

        $this->assertInstanceOf(
            Response::class,
            $this->testedClass->showLoginForm()
        );
    }

    /**
     * @covers ::showLoginForm
     */
    public function testShowLoginFormCompanyLogged()
    {
        $this->dependencies[Auth::class]
            ->shouldReceive('guard')
            ->with('company')
            ->once()
            ->andReturn($this->otherDependencies[SessionGuard::class]);

        $this->otherDependencies[SessionGuard::class]
            ->shouldReceive('check')
            ->with()
            ->once()
            ->andReturn(true);

        $this->dependencies[Auth::class]
            ->shouldReceive('guard')
            ->with('admin')
            ->never();

        $this->otherDependencies[SessionGuard::class]
            ->shouldReceive('check')
            ->with()
            ->never();

        View::shouldReceive('make')
            ->with('company.auth.login', [], [])
            ->never();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->showLoginForm()
        );
    }

    /**
     * @covers ::showLoginForm
     */
    public function testShowLoginFormAdminLogged()
    {
        $this->dependencies[Auth::class]
            ->shouldReceive('guard')
            ->with('company')
            ->once()
            ->andReturn($this->otherDependencies[SessionGuard::class]);

        $this->otherDependencies[SessionGuard::class]
            ->shouldReceive('check')
            ->with()
            ->once()
            ->andReturn(false);

        $this->dependencies[Auth::class]
            ->shouldReceive('guard')
            ->with('admin')
            ->once()
            ->andReturn($this->otherDependencies[SessionGuard::class]);

        $this->otherDependencies[SessionGuard::class]
            ->shouldReceive('check')
            ->with()
            ->once()
            ->andReturn(true);

        View::shouldReceive('make')
            ->with('company.auth.login', [], [])
            ->never();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->showLoginForm()
        );
    }

    /**
     * @covers ::redirectTo
     */
    public function testRedirectTo()
    {
        $method = $this->reflection->getMethod('redirectTo');
        $method->setAccessible(true);

        $this->assertEquals(
            '/company',
            $method->invoke($this->testedClass)
        );
    }

    /**
     * @covers ::username
     */
    public function testUsername()
    {
        $this->assertEquals(
            'login',
            $this->testedClass->username()
        );
    }

    /**
     * @covers ::logout
     */
    public function testLogout()
    {
        $this->dependencies[Auth::class]
            ->shouldReceive('guard')
            ->with('company')
            ->once()
            ->andReturn($this->otherDependencies[SessionGuard::class]);

        $this->otherDependencies[SessionGuard::class]
            ->shouldReceive('logout')
            ->with()
            ->once();

        $this->otherDependencies[Request::class]
            ->shouldReceive('session->invalidate');

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->logout($this->otherDependencies[Request::class])
        );
    }

    /**
     * @covers ::guard
     */
    public function testGuard()
    {
        $this->dependencies[Auth::class]
            ->shouldReceive('guard')
            ->with('company')
            ->once()
            ->andReturn($this->otherDependencies[SessionGuard::class]);

        $method = $this->reflection->getMethod('guard');
        $method->setAccessible(true);

        $this->assertInstanceOf(
            SessionGuard::class,
            $method->invoke($this->testedClass)
        );
    }
}
