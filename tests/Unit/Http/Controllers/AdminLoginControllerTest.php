<?php

namespace Tests\Nero\Evale\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Nero\Evale\Http\Controllers\AdminLoginController;
use Tests\TestCase;
use View;

/**
 * @coversDefaultClass \Nero\Evale\Http\Controllers\AdminLoginController
 */
class AdminLoginControllerTest extends TestCase
{
    protected $testedClassName = AdminLoginController::class;

    protected $activeReflection = true;

    public function setUp()
    {
        $this->otherDependencies = [
            'response' => Mockery::mock(Response::class),
        ];

        $this->dependencies = [
            'auth' => new Auth(),
        ];

        parent::setUp();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $testedClass = new AdminLoginController(...array_values($this->dependencies));

        $this->assertInstanceOf(AdminLoginController::class, $testedClass);
    }

    /**
     * @covers ::showLoginForm
     */
    public function testShowLoginForm()
    {
        $this->dependencies['auth']
            ->shouldReceive('guard->check')
            ->with('company')
            ->with()
            ->once()
            ->shouldReceive('guard->check')
            ->with('admin')
            ->with()
            ->once();

        View::shouldReceive('make')
            ->with('admin.auth.login', [], [])
            ->once()
            ->andReturn($this->otherDependencies['response']);

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
        $this->dependencies['auth']
            ->shouldReceive('guard->check')
            ->with('company')
            ->with()
            ->once()
            ->andReturn(true)
            ->shouldReceive('guard->check')
            ->with('admin')
            ->with()
            ->never();

        View::shouldReceive('make')
            ->with('admin.auth.login', [], [])
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
        $this->dependencies['auth']
            ->shouldReceive('guard->check')
            ->with('company')
            ->with()
            ->once()
            ->shouldReceive('guard->check')
            ->with('admin')
            ->with()
            ->once()
            ->andReturn(true);

        View::shouldReceive('make')
            ->with('admin.auth.login', [], [])
            ->never();

        $this->assertInstanceOf(
            RedirectResponse::class,
            $this->testedClass->showLoginForm()
        );
    }
}
